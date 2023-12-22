<?php
    
	$link = mysqli_connect("localhost", "root", "", "kadr_samdu.uz_DB");

	if (!$link) {

    echo "Xato: MySQL bilan aloqa o'rnatib bo'lmadi.";

    exit();
}
    mysqli_set_charset($link, "utf8");
    class Cyber
    {
        private $url;
        private $host;
        private $user_db;
        private $password;
        private $db;
        private $link;
        private $allow_upload;

        function __construct(){
            $this->url = "http://kadr.samdu.uz/";
            $this->host = "localhost";
            $this->user_db = "root";
            $this->password = "";
            $this->db = "kadr_samdu.uz_DB";            
            $this->allow_upload = array('png','gif','jpg','pdf','doc','docx','xls','xlsx');
            $this->link = mysqli_connect($this->host, $this->user_db, $this->password, $this->db);
            mysqli_set_charset($this->link, "utf8");
        }
        public function begintranz()
        {
            return mysqli_begin_transaction($this->link);
        }
        public function endtranz()
        {
            return mysqli_commit($this->link);
        }
        public function bekor()
        {
            return mysqli_rollback($this->link);
        }
        public function insert($table,$arr){
            $sql = "INSERT INTO $table ";
            $sqltxt1 = "";
            $sqltxt2 = "";
            $n = count($arr);
            $i=0;
            foreach ($arr as $key => $value) {
                $i++;
                if($i==$n){
                    $sqltxt1 .= "$key";
                    $sqltxt2 .= "'".$this->filter($value)."'";
                }
                else{
                    $sqltxt1 .= "$key,";
                    $sqltxt2 .= "'".$this->filter($value)."',";
                }                
            }
            $sql .= "($sqltxt1) VALUES ($sqltxt2)";            
            return $this->query($sql);
        }

        public function update($table,$arr,$cond,$shart="no"){
            $sql = "UPDATE $table SET ";            
            $n = count($arr);
            $i=0;
            foreach ($arr as $key => $value) {
                $i++;
                if($i==$n){
                    $sql .= "$key="."'".$this->filter($value)."'";                    
                }
                else{
                    $sql .= "$key="."'".$this->filter($value)."',";
                }                
            }
            
            if($shart=="no"){
                $sql .= " WHERE ";
                foreach ($cond as $key => $value) {
                    $sql .= " $key='".$value."'";
                    break;
                }
            }
            else{
                $sql .= "WHERE $shart";
            }
            return $this->query($sql);
        }
        public function delete($table,$cond,$shart="no"){
            $sql = "DELETE FROM $table ";
            if($shart=="no"){
                $sql .= "WHERE ";
                foreach ($cond as $key => $value) {
                    $sql .= " $key='".$this->filter($value)."'";
                    break;
                }
            }
            else{
                $sql .= "WHERE ".$this->filter($shart);
            }
            return $this->query($sql);
        }
        public function select($table,$cond,$shart="no"){
            $sql = "SELECT * FROM $table ";
            if($shart=="no"){
                $sql .= " WHERE ";
                foreach ($cond as $key => $value) {
                    $sql .= " $key='".$this->filter($value)."'";
                    break;
                }
            }
            else{
                $sql .= "WHERE ".$this->filter($shart);
            }
            return $this->query($sql);
        }
        public function getdata($table,$cond,$shart="no"){
            $sql = "SELECT * FROM $table ";
            if($shart=="no"){
                $sql .= " WHERE ";
                $i = 0;
                foreach ($cond as $key => $value) {
                    $i++;
                    if($i>=2){
                        $sql .= " AND $key='".$this->filter($value)."'";
                    }
                    else{
                        $sql .= " $key='".$this->filter($value)."'";
                    }                    
                }
            }
            else{
                $sql .= "WHERE ".$shart;
            }            
            $sql = $this->query($sql);
            $fetch = mysqli_fetch_assoc($sql);
            
            return $fetch;
        }
        public function getdatas($table,$cond,$shart="no"){
            $sql = "SELECT * FROM $table ";
            if($shart=="no"){
                $sql .= " WHERE ";
                $i = 0;                
                foreach ($cond as $key => $value) {
                    $i++;
                    if($i>=2){
                        $sql .= "AND $key='".$this->filter($value)."'";
                    }
                    else{
                        $sql .= " $key='".$this->filter($value)."'";
                    }                    
                }
            }
            else{
                $sql .= "WHERE ".$shart;
            }
            $result = array();
            $sql = $this->query($sql);
            while ($fetch = mysqli_fetch_assoc($sql)){
                array_push($result, $fetch);
                // $result += $fetch;
            }
            return $result;
        }
        public function getdatalast($table,$cond,$shart="no"){
            $sql = "SELECT * FROM $table ";
            if($shart=="no"){
                $sql .= " WHERE ";
                foreach ($cond as $key => $value) {
                    $sql .= " $key='".$this->filter($value)."'";
                    break;
                }
            }
            else{
                $sql .= "WHERE ".$shart;
            }            
            $result = array();
            $sql = "ORDER BY id DESC";
            $sql = $this->query($sql);
            while ($fetch = mysqli_fetch_assoc($sql)){   
                array_push($result, $fetch);
                // $result += $fetch;                
            }
            return $result;
        }
        public function gettabledata($table){
            $sql = "SELECT * FROM $table";
            $result = array();
            $sql = $this->query($sql);
            while ($fetch = mysqli_fetch_assoc($sql)){
                array_push($result, $fetch);
                // $result += $fetch;
            }
            return $result;
        }
        public function getdatajson($table,$cond,$shart="no"){
            $sql = "SELECT * FROM $table ";
            if($shart=="no"){
                $sql .= " WHERE ";
                foreach ($cond as $key => $value) {
                    $sql .= " $key='".$this->filter($value)."'";
                    break;
                }
            }
            else{
                $sql .= "WHERE ".$shart;
            }
            $result = array();
            while ($fetch = mysqli_fetch_assoc($this->query($sql))) {
                $result += $fetch;
            }
            $json = json_encode($result);
            return $json;
        }
        public function set_allowupload($arr){
            $this->allow_upload = $arr;
        }
        public function uchirfile   ($file){
            unlink($manzil."/".$_FILES[$file_name]['name']);
        }
        public function yukla($file_name,$manzil){
            $ret = [];
            $sepext = explode('.', strtolower($_FILES[$file_name]['name'])); 
            $type = end($sepext);    /** gets extension **/ 
            if(in_array($type, $this->allow_upload)){
                $_FILES[$file_name]['name'] = md5(time().uniqid()).".".$type;
                if(move_uploaded_file($_FILES[$file_name]['tmp_name'], $manzil."/".$_FILES[$file_name]['name'])){
                    $ret += ['xatolik' => 0, 'xabar' => "Fayl yuklandi", 'file_name' => $_FILES[$file_name]['name'], 'url' => $manzil."/".$_FILES[$file_name]['name']];
                }
                else{
                    $ret += ['xatolik' => 2, 'xabar' => "Fayl yuklnamdi"];
                }
            }
            else{
                $ret += ['xatolik' => 1, 'xabar' => "File kengatmasi to'g'ri kelmadi"];
            }
            return $ret;
        }
        public function filter($s){
            $s = trim($s);
            $s = htmlspecialchars($s, ENT_QUOTES);
            // $s = str_replace("'", "\'", $s);
            return $s;
        }
        public function filterphone($telefon){
            $arr = array("+","(",")","-"," ");
            $ret = "";
            for ($i=0; $i < strlen($telefon); $i++) { 
                if(in_array($telefon[$i], $arr)){
                    continue;
                }
                else{
                    $ret .= $telefon[$i];
                }
            }

            return $ret;
        }
        public function sendsms($telefon, $msg){
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => "http://91.204.239.44/broker-api/send",
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => "",
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 30,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => "POST",
                CURLOPT_POSTFIELDS => "{ \"messages\": [ { \"recipient\": \"$telefon\", \"message-id\": \"2016256\", \"sms\": { \"originator\": \"3700\", \"content\": { \"text\": \"$msg\" } } } ] }",
                CURLOPT_HTTPHEADER => array(
                 "Authorization: Basic c2FtZHU6eDlBYWJDTkZa",
                  "Cache-Control: no-cache",
                  "Content-Type: application/json",
                ),
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                return "no";
            }
            else {
                return "ok";
            }
        }
        public function query($sql)
        {
            return mysqli_query($this->link,"$sql");
        }
        function __destruct() {
            mysqli_close($this->link);
        }
    }
	function filter($s)	{
		$s = trim($s);
        $s = htmlspecialchars($s, ENT_QUOTES);
        return $s;
	}
	function sendsms($telefon, $msg){
        // $telefon = "998937286867";
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://91.204.239.44/broker-api/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{ \"messages\": [ { \"recipient\": \"$telefon\", \"message-id\": \"2016256\", \"sms\": { \"originator\": \"3700\", \"content\": { \"text\": \"RESEARCH.SAMDU.UZ Tasdiqlash kodi :  $msg\" } } } ] }",
            CURLOPT_HTTPHEADER => array(
             "Authorization: Basic c2FtZHU6eDlBYWJDTkZa",
              "Cache-Control: no-cache",
              "Content-Type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            return "no";
        }
        else {
            return "ok";
        }
    }
    function sendmsg($telefon, $msg){
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://91.204.239.44/broker-api/send",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => "{ \"messages\": [ { \"recipient\": \"$telefon\", \"message-id\": \"2016256\", \"sms\": { \"originator\": \"3700\", \"content\": { \"text\": \"SamDU kadrlar bo'limi . $msg\" } } } ] }",
            CURLOPT_HTTPHEADER => array(
             "Authorization: Basic c2FtZHU6eDlBYWJDTkZa",
              "Cache-Control: no-cache",
              "Content-Type: application/json",
            ),
        ));
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);

        if ($err) {
            return "no";
        }
        else {
            return "ok";
        }
    }
    function filterphone($telefon){
        $arr = array("+","(",")","-"," ");
        $ret = "";
        for ($i=0; $i < strlen($telefon); $i++) { 
            if(in_array($telefon[$i], $arr)){
                continue;
            }
            else{
                $ret .= $telefon[$i];
            }
        }

        return $ret;
    }
	////***** MYSQL CONNECT end *****\\\\


class Logins
{
	// LOGIN CHECK BEGIN \\
	static function login($login,$parol)
	{
		global $link;
		 $sql =mysqli_query($link,"SELECT * FROM users WHERE login='$login' and parol='$parol'");
		 return mysqli_fetch_assoc($sql);
	}
	// LOGIN CHECK END \\

}
 ?>
