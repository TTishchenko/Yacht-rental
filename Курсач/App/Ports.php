<?
/*
#	Класс Ports - работа с объектами Ports
# 	@version 1.0
*/

class Ports {
	# конструктор + получение данных по объекту
	public $id;					# id
	public $name;          		# название
	private $error = array();   # массив сообщений об ошибках


	function __construct($id = 0)	{
		global $db_link;

		$this->id = intval($id);

		if ($id > 0)	{
			$this->getData();
		}
		
	}

	# получение всех данных по объекту
	public function getData()	{
		global $db_link;

		try	{
			$query = "";
			if ($this->id > 0)
				$query = "SELECT * FROM ports WHERE id = " . $this->id;
			else throw new Exception("Ports::getData - не заданы параметры");

			if(!$result = $db_link->query($query))
				throw new Exception("Ports::getData - Ошибка во время получения из БД данных, id = " . $this->id);
			
			if ($db_link->affected_rows == 1)	{

				$row = $result->fetch_assoc();
				$this->id = $row["id"];
				$this->name = stripslashes($row["name"]);
				
			}
			else throw new Exception("Ports::getData - объект не существует, id = " . $this->tid);

			$result->close();

		} catch (Exception $e)	{
			$this->error[] = $e->getMessage();
		}

	}


	# удаление тега
	public function deleteTag() {
		global $db_link;

		try	{
			if(!$db_link->query("DELETE FROM ports WHERE id=" . $this->id))
			throw new Exception ("Ports::deleteTag - Ошибка удаления тега, tid = " . $this->id);
			return true;

		}	catch (Exception $e)	{
			$this->error[] = $e->getMessage();
			return false;
		}
	}


	#редактирование данных
	public function saveData($name)	{
		global $db_link;
        $this->notice[] = "Ports::saveData - изменение данных";

		try {
			//проверка заполнения переменных
			if (strlen($name) == 0)	throw new Exception("Ports::saveData - Необходимо ввести название");


				if ($this->id == -1)	{
					if(!$db_link->query("INSERT INTO ports (name) VALUES ('".$db_link->real_escape_string($name)."'"))
					throw new Exception("Ports::saveData - ошибка создания записи");

					$this->id = $db_link->insert_id;
				}
				else	{
					if(!$db_link->query("UPDATE зщкеы SET name='".$db_link->real_escape_string($name)."' WHERE id=".$this->id))
						throw new Exception("Ports::saveData - Ошибка редактирования, id = " . $this->id);
				}
				
				$this->getData();

				return true;


		}	catch (Exception $e)	{
			$this->error[] = $e->getMessage();
			return false;
		}
	}

	# список
	public static function getList($lang, $order = "no", $rang_num = 10)	{
		global $db_link;

		$ordadd = "";
		switch($order)	{

			case "an_name" :
				$ordadd = " ORDER BY an_name ASC";
			break;
			case "an_count" :
				$ordadd = " ORDER BY an_count ASC";
			break;

		}

		$arr = array();

		//максимальное число упоминамия тега
		$result = $db_link->query("SELECT MAX(an_count) AS max FROM ".DATABASE_PREF."tags") or die("can't get max count value");
		$max = $result->fetch_object()->max;

		//все теги
		$result = $db_link->query("SELECT * FROM ".DATABASE_PREF."tags WHERE an_lang = ".intval($lang) . $ordadd)
		   or die ("Tags::getTagsList - Ошибка во время получения из БД списка тегов.");

		while ($row = $result->fetch_assoc())	{
	 		$arr[] = array(
	 		 	"an_tid" => $row["an_tid"],
	 		 	"an_name" 		=> stripslashes($row["an_name"]),
	 		 	"an_count"		=> intval($row["an_count"]),
	 		 	"an_rang"		=> (intval($row["an_count"]) > 0) ? ceil(intval($row["an_count"])/($max/$rang_num)) : 1
	 		);
		}
		$result->close();

		return $arr;
	}


	# получение описания ошибок произошедших во время выполнения методов класса
	public function getErrorMessage($clear = true, $separator = "<br>") {
		$return = implode($separator, $this->error);
		if ($clear)	unset($this->error);

		return $return;
	}

	# добавить ошибку
	public function addErrorMessage($mess) {
		$this->error[] = $mess;
	}


}

?>