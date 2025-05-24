<?php

namespace App\Livewire;

use Exception;
use App\Models\Image;
use Livewire\Component;
use App\Models\Guardian;
use App\Models\Religion;
use App\Models\BloodType;
use App\Models\Nationality;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Lang;

class AddParent extends Component
{
	use WithFileUploads;

	public $step = 0;
	public $email;
	public $password;
	public $fatherNameEn;
	public $fatherNameAr;
	public $fatherJobEn;
	public $fatherJobAr;
	public $fatherIdNumber;
	public $fatherPassportNumber;
	public $fatherPhone;
	public $fatherNationality;
	public $fatherBloodType;
	public $fatherReligion;
	public $fatherAddress;
	public $motherNameEn;
	public $motherNameAr;
	public $motherJobEn;
	public $motherJobAr;
	public $motherIdNumber;
	public $motherPassportNumber;
	public $motherPhone;
	public $motherNationality;
	public $motherBloodType;
	public $motherReligion;
	public $motherAddress;
	public $successMessage = '';
	public $errorMessage = '';
	public $photos = [];
	public $showTable = true;
	public $updateMode = false;
	public $parentId;

	protected function rules()
	{
		return [
			'email' => 'required|email',
			'password' => 'required',
			'fatherNameEn' => 'required',
			'fatherNameAr' => 'required',
			'fatherJobAr' => 'required',
			'fatherJobEn' => 'required',
			'fatherIdNumber' => 'required|min:10|max:10|string|regex:/[0-9]{9}/',
			'fatherPassportNumber' => 'required|min:10|max:10',
			'fatherPhone' => 'required|regex:/^([0-9\s\-\+(\)]*)$/|min:10',
			'fatherNationality' => 'required|exists:nationality,id',
			'fatherBloodType' => 'required|exists:blood_types,id',
			'fatherReligion' => 'required|exists:religions,id',
			'fatherAddress' => 'required',
			//            ---------------------------------------------
			'motherNameEn' => 'required',
			'motherNameAr' => 'required',
			'motherJobAr' => 'required',
			'motherJobEn' => 'required',
			'motherIdNumber' => 'required|min:10|max:10|string|regex:/[0-9]{9}/',
			'motherPassportNumber' => 'required|min:10|max:10',
			'motherPhone' => 'required|regex:/^([0-9\s\-\+(\)]*)$/|min:10',
			'motherNationality' => 'required|exists:nationality,id',
			'motherBloodType' => 'required|exists:blood_types,id',
			'motherReligion' => 'required|exists:religions,id',
			'motherAddress' => 'required',
			'photos.*' => 'image|max:1024'
		];
	}
	protected function messages()
	{
		return [
			'email.required' => trans('parent.emailReq'),
			'email.email' => trans('parent.isEmail'),
			'password.required' => trans('parent.passwordReq'),
			'fatherNameEn.required' => trans('parent.fatherNameEnReq'),
			'fatherNameAr.required' => trans('parent.fatherNameArReq'),
			'fatherJobAr.required' => trans('parent.fatherNameArReq'),
			'fatherJobEn.required' =>  trans('parent.fatherNameEnReq'),
			'fatherIdNumber.required' => trans('parent.fatherIdNumberReq'),
			'fatherIdNumber.min' => trans('parent.fatherIdNumberMin'),
			'fatherIdNumber.max' => trans('parent.fatherIdNumberMax'),
			'fatherIdNumber.string' => trans('parent.fatherIdNumberString'),
			'fatherIdNumber.regex' => trans('parent.fatherIdNumberRegex'),
			'fatherPassportNumber.required' => trans('parent.fatherPassportNumberReq'),
			'fatherPassportNumber.min' => trans('parent.fatherPassportNumberMin'),
			'fatherPassportNumber.max' => trans('parent.fatherPassportNumberMax'),
			'fatherPhone.required' => trans('parent.fatherPhoneRequired'),
			'fatherPhone.regex' => trans('parent.fatherPhoneRegex'),
			'fatherPhone.min' => trans('parent.fatherPhoneMin'),
			'fatherNationality.required' => trans('parent.fatherNationality'),
			'fatherNationality.exists' => trans('parent.fatherNationalityExists'),
			'fatherBloodType.required' => trans('parent.fatherBloodTypeReq'),
			'fatherBloodType.exists' => trans('parent.fatherBloodTypeExists'),
			'fatherReligion.required' => trans('parent.fatherReligionReq'),
			'fatherReligion.exists' => trans('parent.fatherReligionExists'),
			'motherNameEn.required' => trans('parent.motherNameEnReq'),
			'motherNameAr.required' => trans('parent.motherNameArReq'),
			'motherJobAr.required' => trans('parent.motherNameArReq'),
			'motherJobEn.required' =>  trans('parent.motherNameEnReq'),
			'motherIdNumber.required' =>  trans('parent.motherIdNumberReq'),
			'motherIdNumber.min' => trans('parent.motherIdNumberMin'),
			'motherIdNumber.max' => trans('parent.motherIdNumberMax'),
			'motherIdNumber.string' =>  trans('parent.motherIdNumberString'),
			'motherIdNumber.regex' => trans('parent.motherIdNumberRegex'),
			'motherPassportNumber.required' =>  trans('parent.motherPassportNumberReq'),
			'motherPassportNumber.min' => trans('parent.motherPassportNumberMin'),
			'motherPassportNumber.max' => trans('parent.motherPassportNumberMax'),
			'motherPhone.required' => trans('parent.motherPhoneRequired'),
			'motherPhone.regex' => trans('parent.motherPhoneRegex'),
			'motherPhone.min' => trans('parent.motherPhoneMin'),
			'motherNationality.required' => trans('parent.motherNationality'),
			'motherNationality.exists' => trans('parent.motherNationalityExists'),
			'motherBloodType.required' => trans('parent.motherBloodTypeReq'),
			'motherBloodType.exists' => trans('parent.motherBloodTypeExists'),
			'motherReligion.required' => trans('parent.motherReligionReq'),
			'motherReligion.exists' => trans('parent.motherReligionExists'),
			'motherAddress' => trans('parent.addressReq'),
			'fatherAddress' => trans('parent.addressReq'),
		];
	}
	public function updated($propertyName)
	{
		$this->validateOnly($propertyName);
	}
	public function render()
	{
		$showTable = true;
		$langFile = 'datatables'; // Language file name without the language prefix
		$translations = Lang::get($langFile);
		$nationalities = Nationality::all();
		$bloodTypes = BloodType::all();
		$religions = Religion::all();
		$guardians = Guardian::all();
		return view('livewire.add-parent', compact('nationalities', 'bloodTypes'))->with(['religions' => $religions, 'translations' => $translations, 'guardians' => $guardians]);
	}
	public function submitFirstStep()
	{
		$this->validate([
			'email' => 'required|email|unique:guardians,email,' . $this->id,
			'password' => 'required',
		]);
		$this->step = 1;
	}
	public function submitSecondStep()
	{
		$this->validate([
			'fatherNameEn' => 'required',
			'fatherNameAr' => 'required',
			'fatherJobAr' => 'required',
			'fatherJobEn' => 'required',
			'fatherIdNumber' => 'required|min:10|max:10|string|regex:/[0-9]{9}/|unique:guardians,fatherIdNumber,' . $this->id,
			'fatherPassportNumber' => 'required|min:10|max:10|unique:guardians,fatherPassportNumber,' . $this->id,
			'fatherPhone' => 'required|regex:/^([0-9\s\-\+(\)]*)$/|min:10',
			'fatherNationality' => 'required|exists:nationality,id',
			'fatherBloodType' => 'required|exists:blood_types,id',
			'fatherReligion' => 'required|exists:religions,id',
			'fatherAddress' => 'required',
		]);
		$this->step = 2;
	}
	public function submitThirdStep()
	{
		$this->validate([
			'motherNameEn' => 'required',
			'motherNameAr' => 'required',
			'motherJobAr' => 'required',
			'motherJobEn' => 'required',
			'motherIdNumber' => 'required|min:10|max:10|string|regex:/[0-9]{9}/|unique:guardians,motherIdNumber,' . $this->id,
			'motherPassportNumber' => 'required|min:10|max:10|unique:guardians,motherPassportNumber,' . $this->id,
			'motherPhone' => 'required|regex:/^([0-9\s\-\+(\)]*)$/|min:10',
			'motherNationality' => 'required|exists:nationality,id',
			'motherBloodType' => 'required|exists:blood_types,id',
			'motherReligion' => 'required|exists:religions,id',
			'motherAddress' => 'required',
		]);
		$this->step = 3;
	}
	public function previous($step)
	{
		$this->step = $step;
	}
	function clearForm()
	{
		$this->email = '';
		$this->password = '';
		$this->fatherNameEn = '';
		$this->fatherNameAr = '';
		$this->fatherIdNumber = '';
		$this->fatherPassportNumber = '';
		$this->fatherPhone = '';
		$this->fatherJobEn = '';
		$this->fatherJobAr = '';
		$this->fatherNationality = '';
		$this->fatherBloodType = '';
		$this->fatherReligion = '';
		$this->fatherAddress = '';
		$this->motherNameEn = '';
		$this->motherIdNumber = '';
		$this->motherPassportNumber = '';
		$this->motherPhone = '';
		$this->motherJobEn = '';
		$this->motherJobAr = '';
		$this->motherNationality = '';
		$this->motherBloodType = '';
		$this->motherReligion = '';
		$this->motherAddress = '';
	}
	public function submitForm()
	{
		try {
			$guardian = new Guardian();
			$guardian->email = $this->email;
			$guardian->password = Hash::make($this->password);
			$fatherNameTranslations = ['en' => $this->fatherNameEn, 'ar' => $this->fatherNameAr];
			$guardian->fatherName = $fatherNameTranslations;
			$guardian->fatherIdNumber = $this->fatherIdNumber;
			$guardian->fatherPassportNumber = $this->fatherPassportNumber;
			$guardian->fatherPhone = $this->fatherPhone;
			$fatherJobTranslations = ['en' => $this->fatherJobEn, 'ar' => $this->fatherJobAr];
			$guardian->fatherJob = $fatherJobTranslations;
			$guardian->fatherNationalityId = $this->fatherNationality;
			$guardian->fatherBloodTypeId = $this->fatherBloodType;
			$guardian->fatherReligionId = $this->fatherReligion;
			$guardian->fatherAddress = $this->fatherAddress;
			// -------------------------------------------
			$motherNameTranslations = ['en' => $this->motherNameEn, 'ar' => $this->motherNameAr];
			$guardian->motherName = $motherNameTranslations;
			$guardian->motherIdNumber = $this->motherIdNumber;
			$guardian->motherPassportNumber = $this->motherPassportNumber;
			$guardian->motherPhone = $this->motherPhone;
			$motherJobTranslations = ['en' => $this->motherJobEn, 'ar' => $this->motherJobAr];
			$guardian->motherJob = $motherJobTranslations;
			$guardian->motherNationalityId = $this->motherNationality;
			$guardian->motherBloodTypeId = $this->motherBloodType;
			$guardian->motherReligionId = $this->motherReligion;
			$guardian->motherAddress = $this->motherAddress;
			$guardian->save();
			if (!empty($this->photos)) {
				foreach ($this->photos as $photo) {
					$name = $photo->getClientOriginalName();
					$photo->storeAs($this->fatherIdNumber, $photo->getClientOriginalName(), $disk = 'parent_attachments');
					$image = new Image();
					$image->url = $name;
					$image->imageable_id = $guardian->id;
					$image->imageable_type = 'App\Models\Guardian'; // Ensure the model and namespace are correct
					$image->save();
				}
			}
			$this->successMessage = trans('message.dataSaved');
			$this->clearForm();
			$this->showTable = true;
		} catch (Exception $th) {
			$this->errorMessage = $th->getMessage();
			$this->step = 0;
		}
	}
	public function showAddForm()
	{
		$this->showTable = false;
	}
	public function editForm($id)
	{
		$this->showTable = false;
		$this->updateMode = true;
		$guardian = Guardian::findOrFail($id);
		$this->parentId = $id;
		$this->email = $guardian->email;
		$this->password = $guardian->password;
		$this->fatherNameEn = $guardian->getTranslation('fatherName', 'en');
		$this->fatherNameAr = $guardian->getTranslation('fatherName', 'ar');
		$this->fatherIdNumber = $guardian->fatherIdNumber;
		$this->fatherPassportNumber = $guardian->fatherPassportNumber;
		$this->fatherPhone = $guardian->fatherPhone;
		$this->fatherJobEn = $guardian->getTranslation('fatherJob', 'en');
		$this->fatherJobAr = $guardian->getTranslation('fatherJob', 'ar');
		$this->fatherNationality = $guardian->fatherNationalityId;
		$this->fatherBloodType = $guardian->fatherBloodTypeId;
		$this->fatherReligion = $guardian->fatherReligionId;
		$this->fatherAddress = $guardian->fatherAddress;
		// -------------------------------------------
		$this->motherNameEn = $guardian->getTranslation('motherName', 'en');
		$this->motherNameAr = $guardian->getTranslation('motherName', 'ar');
		$this->motherIdNumber = $guardian->motherIdNumber;
		$this->motherPassportNumber = $guardian->motherPassportNumber;
		$this->motherPhone = $guardian->motherPhone;
		$this->motherJobEn = $guardian->getTranslation('motherJob', 'en');
		$this->motherJobAr = $guardian->getTranslation('motherJob', 'ar');
		$this->motherNationality = $guardian->motherNationalityId;
		$this->motherBloodType = $guardian->motherBloodTypeId;
		$this->motherReligion = $guardian->motherReligionId;
		$this->motherAddress = $guardian->motherAddress;
	}
	public function submitUpdateFirstStep()
	{
		$this->updateMode = true;
		$this->step = 1;
	}
	public function submitUpdateSecondStep()
	{
		$this->updateMode = true;
		$this->step = 2;
	}
	public function submitUpdateThirdStep()
	{
		$this->updateMode = true;
		$this->step = 3;
	}
	public function edit()
	{
		if ($this->parentId) {
			$guardian = Guardian::findOrFail($this->parentId);
			$guardian->email = $this->email;
			$guardian->password = Hash::make($this->password);
			$fatherNameTranslations = ['en' => $this->fatherNameEn, 'ar' => $this->fatherNameAr];
			$guardian->fatherName = $fatherNameTranslations;
			$guardian->fatherIdNumber = $this->fatherIdNumber;
			$guardian->fatherPassportNumber = $this->fatherPassportNumber;
			$guardian->fatherPhone = $this->fatherPhone;
			$fatherJobTranslations = ['en' => $this->fatherJobEn, 'ar' => $this->fatherJobAr];
			$guardian->fatherJob = $fatherJobTranslations;
			$guardian->fatherNationalityId = $this->fatherNationality;
			$guardian->fatherBloodTypeId = $this->fatherBloodType;
			$guardian->fatherReligionId = $this->fatherReligion;
			$guardian->fatherAddress = $this->fatherAddress;
			// -------------------------------------------
			$motherNameTranslations = ['en' => $this->motherNameEn, 'ar' => $this->motherNameAr];
			$guardian->motherName = $motherNameTranslations;
			$guardian->motherIdNumber = $this->motherIdNumber;
			$guardian->motherPassportNumber = $this->motherPassportNumber;
			$guardian->motherPhone = $this->motherPhone;
			$motherJobTranslations = ['en' => $this->motherJobEn, 'ar' => $this->motherJobAr];
			$guardian->motherJob = $motherJobTranslations;
			$guardian->motherNationalityId = $this->motherNationality;
			$guardian->motherBloodTypeId = $this->motherBloodType;
			$guardian->motherReligionId = $this->motherReligion;
			$guardian->motherAddress = $this->motherAddress;
			$guardian->save();
			$this->successMessage = trans('message.dataUpdated');
			$this->clearForm();
			$this->showTable = true;
		}
	}
	public function delete($id)
	{
		Guardian::findOrFail($id)->delete();

		$this->successMessage = trans('message.dataDeleted');
		return redirect()->to('/parent');
	}
}
