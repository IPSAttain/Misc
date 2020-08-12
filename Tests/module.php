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
			$this->Tests($visible);
		}

		private function Tests($visible)
		{
			$this->UpdateFormField("amount", "visible", $visible);
			$this->ReloadForm();
			$this->SendDebug("Test","Its true",0);
		}

	}