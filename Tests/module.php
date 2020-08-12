<?php
	class Tests extends IPSModule {

		public function Create()
		{
			//Never delete this line!
			parent::Create();

			// test 2
			
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

			$visible = $this->ReadPropertyBoolean("Visible");
			$this->TestVis($visible);
		}

		private function TestVis($visible)
		{
			$this->UpdateFormField("amount", "visible", $visible);
			if ($visible)
			{
				$this->UpdateFormField("Button", "caption", "AN");
				$this->SendDebug("Test","Its true",0);
			} else {
				$this->UpdateFormField("Button", "caption", "AUS");
				$this->SendDebug("Test","Its false",0);
			}
			
			//$this->ReloadForm();
			
		}

	}