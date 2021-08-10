<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\m_signin;

class m_cart extends Model
{
    public const ITEM_DELETED = 0;
    public const ITEM_STOCK_DECREASED = 1;
    public const DEFAULT_ITEM_AMOUNT = 1;

    private const MIN_RANDOM = 0;
    private const MAX_RANDOM = 0x7FFFFFFFFFFFFFFF;

    private $signin;
    private $database;

    function __construct()
    {
        $this->signin = new m_signin();
        $this->database = db_connect();
    }

    public function setCart(string $itemName, int $itemAmount)
    {
        $cart = $this->signin->getAppSession('cart');
        $cart[$itemName]['itemAmount'] = $itemAmount;
        $this->signin->setAppSession('cart', $cart);
    }

    public function addCart(string $itemName, int $itemAmount)
    {
        $cart = $this->signin->getAppSession('cart');
        if (!isset($cart[$itemName]))
            $this->setCart($itemName, 0);
        $cart = $this->signin->getAppSession('cart');
        $cart[$itemName]['itemAmount'] += $itemAmount;
        $this->signin->setAppSession('cart', $cart);
    }

    public function getCart()
    {
        $auth = $this->signin->getAuth();
        $cart = $this->signin->getAppSession('cart');
        $umkmId = $auth['umkmId'];
        $cartInfo = [
            'cart' => [],
            'changed' => [],
        ];
        if (empty($cart))
            return $cartInfo;
        foreach ($cart as $itemName => $itemInfo) {
            $itemAmount = $itemInfo['itemAmount'];
            $sql = "SELECT harga_barang, stok_barang
                    FROM barang
                    WHERE id_umkm = $umkmId
                    AND nama_barang = '$itemName'";
            $result = $this->database->query($sql)->getResultArray();
            foreach ($result as $items) {
                $itemPrice = $items['harga_barang'];
                $itemStock = $items['stok_barang'];
            }
            if (empty($result) || $itemStock == 0) {
                array_push($cartInfo['changed'], [
                    'itemName' => $itemName,
                    'code' => m_cart::ITEM_DELETED
                ]);
                unset($cart[$itemName]);
                continue;
            }
            if ($itemAmount > $itemStock) {
                array_push($cartInfo['changed'], [
                    'itemName' => $itemName,
                    'code' => m_cart::ITEM_STOCK_DECREASED
                ]);
                $cart[$itemName]['itemAmount'] = $itemStock;
            }
            $cart[$itemName]['itemPrice'] = $itemPrice;
            $cart[$itemName]['itemStock'] = $itemStock;
        }
        ksort($cart);
        $this->signin->setAppSession('cart', $cart);
        $cartInfo['cart'] = $cart;
        return $cartInfo;
    }

    public function delCart(string $itemName = null)
    {
        if ($itemName != null) {
            $cart = $this->signin->getAppSession('cart');
            if (!isset($cart[$itemName]))
                return;
            unset($cart[$itemName]);
            $this->signin->setAppSession('cart', $cart);
            return;
        }
        $this->signin->setAppSession('cart', []);
    }

    private function gentxnId()
    {
        do {
            $randomInt = random_int(m_cart::MIN_RANDOM, m_cart::MAX_RANDOM);
            $sql = "SELECT id_transaksi
                    FROM transaksi
                    WHERE id_transaksi = $randomInt";
            $result = $this->database->simpleQuery($sql);
        } while ($result->num_rows != 0);
        return $randomInt;
    }

    private function addTxn(
        int $umkmId,
        int $paymentStatus,
        string $description,
        $cart
    ) {
        $txnId = $this->gentxnId();
        $sql = "INSERT INTO transaksi
                VALUES(
                    $txnId,
                    $umkmId,
                    $paymentStatus,
                    '$description',
                    UTC_TIMESTAMP()
                )";
        $this->database->simpleQuery($sql);
        foreach ($cart as $itemName => $itemInfo) {
            $itemPrice = $itemInfo['itemPrice'];
            $itemAmount = $itemInfo['itemAmount'];
            $sql = "INSERT INTO penjualan
                    VALUES($txnId, '$itemName', $itemPrice, $itemAmount)";
            $this->database->simpleQuery($sql);
        }
        return $txnId;
    }

    public function release(int $paymentStatus, string $description)
    {
        $auth = $this->signin->getAuth();
        $cart = $this->signin->getAppSession('cart');
        if (empty($cart))
            return null;
        $umkmId = $auth['umkmId'];
        $this->database->simpleQuery("BEGIN");
        foreach ($cart as $itemName => $itemInfo) {
            $itemAmount = $itemInfo['itemAmount'];
            $sql = "SELECT stok_barang
                    FROM barang
                    WHERE id_umkm = $umkmId
                    AND nama_barang = '$itemName'
                    FOR UPDATE";
            $result = $this->database->query($sql);
            if ($result->getNumRows() == 0) {
                $this->database->simpleQuery("ROLLBACK");
                return null;
            }
            $result = $result->getResultArray();
            foreach ($result as $items)
                $itemStock = $items['stok_barang'];
            if ($itemAmount > $itemStock) {
                $this->database->simpleQuery("ROLLBACK");
                return null;
            }
            $releaseItemStock = $itemStock - $itemAmount;
            $sql = "UPDATE barang
                    SET stok_barang = $releaseItemStock
                    WHERE id_umkm = $umkmId
                    AND nama_barang = '$itemName'";
            $this->database->simpleQuery($sql);
        }
        $txnId = $this->addTxn($umkmId, $paymentStatus, $description, $cart);
        $this->database->simpleQuery("COMMIT");
        $this->delCart();
        return $txnId;
    }

    function __destruct()
    {
        $this->database->close();
    }
}
