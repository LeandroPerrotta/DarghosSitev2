<?
class Accounts
{
	private $data = array
	(
		'id' => null,
		'password' => null,
		'email' => null,
		'creation' => null,
		'lastday' => null,
	);
	
	private $emailChanger = array
	(
		'email' => null,
		'date' => null,
	);

	public function __construct()
	{	
		$this->DB = Database::getInstance();
	}
	
	function getNumber($rand = array(100000,999999))
	{
		$random = rand($rand[0],$rand[1]);
		$number = $random;
		$exist = array();

		$this->DB->query("SELECT `id` FROM `accounts`");
		
        foreach($this->DB->fetch() as $account)
        {
            $exist[] = $account['id'];
        }	
		
        while(true)
        {
            if( !in_array($number, $exist) )
            {
                break;
            }

            $number++;

            if($number > $max)
            {
                $number = $min;
            }

            if($number == $random)
            {
                return false;
            }
        }
		
		$this->data['id'] = $number;	
		return $number;		
	}

	function saveNumber()
	{
		$this->DB->query("INSERT INTO accounts (`id`,`password`,`email`,`creation`) values (".$this->data['id'].",'".$this->data['password']."','".$this->data['email']."',".$this->data['creation'].")");
	}
	
	function update($value)
	{
		$infoCount = count($value);
		
		foreach($value as $info)
		{
			$i++;
			$update .= "$info = '".$this->data[$info]."'";
			
			if($i == $infoCount)
				$update .= " ";
			else
				$update .= ", ";
		}
		
		$this->DB->query("UPDATE accounts SET $update WHERE id = '".$this->data['id']."'");
	}	
	
	function loadByEmail($value)
	{	
		$this->DB->query("SELECT id FROM accounts WHERE email = '$value'");
		
		if($this->DB->num_rows() != 0)
		{
			$fech = $this->DB->fetch();
			$this->data['id'] = $fetch->id;
			
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function loadByNumber($value, $fields = "default")
	{	
		if($fields != "default")
		{
			$infoCount = count($fields);
			
			foreach($fields as $info)
			{
				$i++;
				$select .= "$info";
				
				if($i == $infoCount)
					$select .= " ";
				else
					$select .= ", ";
			}	
			
			$this->DB->query("SELECT id, $select FROM accounts WHERE id = $value");	
			
			if($this->DB->num_rows() != 0)
			{		
				$fetch = $this->DB->fetch();
				
				$this->data['id'] = $fetch->id;
				
				foreach($fields as $info)
				{
					$this->data[$info] = $fetch->$info;
				}	
				
				return true;
			}
			else
				return false;
		}
		else
		{
			$this->DB->query("SELECT id, password, email, real_name, location, url FROM accounts WHERE id = $value");
		
			if($this->DB->num_rows() != 0)
			{
				$fetch = $this->DB->fetch();
				
				$this->data['id'] = $fetch->id;
				$this->data['password'] = $fetch->password;
				$this->data['email'] = $fetch->email;
				$this->data['real_name'] = $fetch->real_name;
				$this->data['location'] = $fetch->location;
				$this->data['url'] = $fetch->url;
				
				return true;
			}
			else
			{
				return false;
			}
		}
	}	
	
	function loadEmailChanger()
	{	
		$this->DB->query("SELECT site.scheduler_changeemails.`email`,site.scheduler_changeemails.`date` FROM site.scheduler_changeemails INNER JOIN `accounts` ON site.scheduler_changeemails.`account_id` = accounts.`id` WHERE accounts.`id` = '".$this->data['id']."'");
	
		if($this->DB->num_rows() != 0)
		{
			$fetch = $this->DB->fetch();
			
			$this->emailChanger['email'] = $fetch->email;
			$this->emailChanger['date'] = $fetch->date;
			
			return true;
		}	
		else	
			return false;
	}
	
	function schedulerNewEmailIn($email, $date)
	{
		$this->DB->query("INSERT INTO site.scheduler_changeemails (`account_id`,`email`,`date`) values (".$this->data['id'].", '".$email."', ".$date.")");
	}
	
	function cancelChangeEmail()
	{
		$this->DB->query("DELETE FROM site.scheduler_changeemails WHERE account_id = '".$this->data['id']."'");
	}
	
	function setData($data, $value)
	{
		$this->data[$data] = $value;
	}
	
	function getData($data)
	{
		return $this->data[$data];
	}
	
	function getEmailChangerData($data)
	{
		return $this->emailChanger[$data];
	}
}
?>