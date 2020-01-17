<?php
class DES
{
    /**
           * @var 
     */
    protected $method;
 
    /**
           * @var 
     */
    protected $key;
 
    /**
           * @var 
     */
    protected $output;
 
    /**
           * @var 
     */
    protected $iv;
 
    /**
     * @var string $options
     */
    protected $options;
 
         // type of output
    const OUTPUT_NULL = '';
    const OUTPUT_BASE64 = 'base64';
    const OUTPUT_HEX = 'hex';
 
 
    /**
     * DES constructor.
     * @param string $key
     * @param string $method
           *             
     *
     * @param string $output
     *      base64、hex
     *
     * @param string $iv
     * @param int $options
     */
    public function __construct($key, $method = 'DES-ECB', $output = '', $iv = '', $options = OPENSSL_RAW_DATA | OPENSSL_NO_PADDING)
    {
        $this->key = $key;
        $this->method = $method;
        $this->output = $output;
        $this->iv = $iv;
        $this->options = $options;
    }
 
    /**
           * Encryption
     *
     * @param $str
     * @return string
     */
    public function encrypt($str)
    {
        $str = $this->pkcsPadding($str, 8);
        $sign = openssl_encrypt($str, $this->method, $this->key, $this->options, $this->iv);
 
        if ($this->output == self::OUTPUT_BASE64) {
            $sign = base64_encode($sign);
        } else if ($this->output == self::OUTPUT_HEX) {
            $sign = bin2hex($sign);
        }
 
        return $sign;
    }
 
    /**
           * Decrypt
     *
     * @param $encrypted
     * @return string
     */
    public function decrypt($encrypted)
    {
        if ($this->output == self::OUTPUT_BASE64) {
            $encrypted = base64_decode($encrypted);
        } else if ($this->output == self::OUTPUT_HEX) {
            $encrypted = hex2bin($encrypted);
        }
 
        $sign = @openssl_decrypt($encrypted, $this->method, $this->key, $this->options, $this->iv);
        $sign = $this->unPkcsPadding($sign);
        $sign = rtrim($sign);
        return $sign;
    }
 
    /**
           * Fill
     *
     * @param $str
     * @param $blocksize
     * @return string
     */
    private function pkcsPadding($str, $blocksize)
    {
        $pad = $blocksize - (strlen($str) % $blocksize);
        return $str . str_repeat(chr($pad), $pad);
    }
 
    /**
           * to fill
     * 
     * @param $str
     * @return string
     */
    private function unPkcsPadding($str)
    {
        $pad = ord($str{strlen($str) - 1});
        if ($pad > strlen($str)) {
            return false;
        }
        return substr($str, 0, -1 * $pad);
    }
 
}

 /*
 // DES CBC encryption and decryption CIPHER BLOCK CHAINING
$key = 'yakup';
$iv = 'iv123456';
$des = new DES($key, 'DES-CBC', DES::OUTPUT_BASE64, $iv);
echo $base64Sign = $des->encrypt('Wozniak');
echo "\n";
echo $des->decrypt($base64Sign);
echo "\n";
 */
 // DES ECB encryption and decryption
/*
$des = new DES($key, 'DES-ECB', DES::OUTPUT_HEX);
echo $base64Sign = $des->encrypt('Hello DES ECB');
echo "\n";
echo $des->decrypt($base64Sign);
*/