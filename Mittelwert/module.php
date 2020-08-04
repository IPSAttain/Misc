<?php
	class Mittelwert extends IPSModule {

		public function Create()
		{
			//Never delete this line!
			parent::Create();

			$this->RegisterPropertyInteger("SourceVariable", 0);
			$this->RegisterPropertyInteger("TargetVariable", 0);
			$this->RegisterPropertyInteger("amount", 0);
			$this->RegisterPropertyBoolean("Visible", 0);
		}

		public function Destroy()
		{
			//Never delete this line!
			parent::Destroy();
		}

		public function ApplyChanges()
		{
			//Never delete this line!
			parent::ApplyChanges();

			$this->RegisterMessage($this->ReadPropertyInteger("SourceVariable"), 10603  /* VM_UPDATE */);
			$this->SetBuffer("DataBuffer", "");
			$this->SetBuffer("Index", 0);
			$this->ChangeVisible();
		}

		private function ChangeVisible()
		{
			if ($this->ReadPropertyBoolean("Visible"))
			{
				$this->UpdateFormField("Button", "visible", true);
				$this->SendDebug("Test","Its true",0);
			} else
			{
				$this->UpdateFormField("Button", "visible", false);
				$this->SendDebug("Test","Its false",0);
			}
		}
		public function MessageSink($TimeStamp, $SenderID, $Message, $Data) 
		{
			$buffer = explode("|",str_replace(',' , '.',$this->GetBuffer("DataBuffer"))); 
			$index = $this->GetBuffer("Index"); 
			if($index >= $this->ReadPropertyInteger("amount")) $index = 0;			// overflow

			$buffer[$index] = floatval(str_replace(',' , '.',$Data[0]));			// add new value
			$average = array_sum($buffer) / count($buffer);							// calculate
			$this->SetBuffer("DataBuffer", implode("|",$buffer));					// array to string to buffer
			$this->SetBuffer("Index", $index + 1);									// Index buffer
			$this->SendDebug("Buffer",$this->GetBuffer("DataBuffer"),0);
			$this->SendDebug("Index",$index + 1,0);
			$this->SendDebug("Average",$average,0);
			SetValue($this->ReadPropertyInteger("TargetVariable"),$average);
		}
	}