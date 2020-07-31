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

		private function Calc()
		{
			$buffer = explode("|",$this->GetBuffer("DataBuffer")); 
			$index  = $buffer[0]+1;													// Index einlesen und um 1 erhöhen
			if ($index > $this->ReadPropertyInteger("amount")) $index = 1;			// Überlauf
			$buffer[0] = 0;
			$buffer[$index] = $this->ReadPropertyInteger("SourceVariable");			// neuen Messwert ins Array eintragen
			$average = array_sum($buffer) / $this->ReadPropertyInteger("amount");	// Mittelwert berechnen
			$buffer[0] = $index;                                        // neuen Index ins Array eintragen
			$this->SetBuffer("DataBuffer", implode("|",$buffer));					// im Infobereich der Variablen, das Array ablegen
			SetValue($this->ReadPropertyInteger("TargetVariable"),$average);      
		}
	}