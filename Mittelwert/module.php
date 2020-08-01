<?php
	class Mittelwert extends IPSModule {

		public function Create()
		{
			//Never delete this line!
			parent::Create();

			$this->RegisterPropertyInteger("SourceVariable", 0);
			$this->RegisterPropertyInteger("TargetVariable", 0);
			$this->RegisterPropertyInteger("amount", 0);
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
		}

		public function MessageSink($TimeStamp, $SenderID, $Message, $Data) 
		{
			$buffer = explode("|",$this->GetBuffer("DataBuffer")); 
			$index = $this->GetBuffer("Index") + 1; 
			$this->SendDebug("Buffer",$this->GetBuffer("DataBuffer"),0);
			$this->SendDebug("Index",$index,0);
			//IPS_LogMessage("MessageSink", "Message from SenderID ".$SenderID." with Message ".$Message."\r\n Data: ".print_r($Data, true));
			if ($index >= $this->ReadPropertyInteger("amount")) $index = 0;			// Überlauf
			$this->SetBuffer("Index", $index);
			$buffer[$index] = $Data[0];			// neuen Messwert ins Array eintragen
			$average = array_sum($buffer) / $this->ReadPropertyInteger("amount");	// Mittelwert berechnen
			$this->SetBuffer("DataBuffer", implode("|",$buffer));					// im Infobereich der Variablen, das Array ablegen
			$this->SendDebug("Average",$average,0);
			SetValue($this->ReadPropertyInteger("TargetVariable"),$average);      
		}
	}