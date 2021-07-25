<?php

namespace App\Models;

use CodeIgniter\Model;
use App\Models\m_signin;

class m_cart extends Model {
    public const ITEM_DELETED = 0;
    public const ITEM_STOCK_DECREASED= 1;
    public const DEFAULT_ITEM_AMOUNT = 1;

    private $signin;
    private $database;

    function __construct() {
		$this->signin = new m_signin();
        $this->database = db_connect();
	}

    public function setCart(string $itemName, $itemAmount) {
        $cart = $cart = $this->signin->getAppSession('cart');
        $cart[$itemName]['itemAmount'] = $itemAmount;
        $this->signin->setAppSession('cart', $cart);
    }

    public function addCart(string $itemName, $itemAmount) {
        $cart = $this->signin->getAppSession('cart');
        if( !isset($cart[$itemName]) )
            $this->setCart($itemName, 0);
        $cart = $this->signin->getAppSession('cart');
        $cart[$itemName]['itemAmount'] += $itemAmount;
        $this->signin->setAppSession('cart', $cart);
    }

    public function getCart() {
        $auth = $this->signin->getAuth();
        $cart = $this->signin->getAppSession('cart');
        $cart = $cart==null ? [] : $cart;
        $idUmkm = $auth['idUmkm'];
        $cartInfo = [
            'cart' => [],
            'changed' => [],
        ];
        foreach($cart as $itemName => $itemInfo) {
            $itemAmount = $itemInfo['itemAmount'];
            $sql = "SELECT harga_barang, stok_barang
                    FROM barang
                    WHERE id_umkm = '$idUmkm'
                    AND nama_barang = '$itemName'";
            $result = $this->database->query($sql);
            if( $result->getNumRows()==0 ) {
                array_push($cartInfo['changed'], [
                    'itemName' => $itemName,
                    'code' => m_cart::ITEM_DELETED
                ]);
                unset($cart[$itemName]);
                continue;
            }
            $result = $result->getResultArray();
            foreach($result as $realItem) {
                $realItemPrice = $realItem['harga_barang'];
                $itemStock = $realItem['stok_barang'];
            }
            if( $itemAmount>$itemStock ) {
                array_push($cartInfo['changed'], [
                    'itemName' => $itemName,
                    'code' => m_cart::ITEM_STOCK_DECREASED
                ]);
                $cart[$itemName]['itemAmount'] = $itemStock;
            }
            $cart[$itemName]['itemPrice'] = $realItemPrice;
            $cart[$itemName]['itemStock'] = $itemStock;
        }
        ksort($cart);
        $this->signin->setAppSession('cart', $cart);
        $cartInfo['cart'] = $cart;
        return $cartInfo;
    }

    function __destruct() {
        $this->database->close();
    }
}