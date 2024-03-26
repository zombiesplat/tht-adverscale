<?php

namespace App\Livewire;

use Carbon\Carbon;
use Illuminate\Validation\Validator;
use Livewire\Component;

class MarriageCertificate extends Component
{
    public $step = 1;

    public $first_name = '';
    public $last_name = '';
    public $address = '';
    public $city = '';
    public $country = '';
    public $dob_day = '';
    public $dob_month = '';
    public $dob_year = '';


    public $is_married = '';
    public $is_widowed = '';
    public $was_married = '';
    public $date_of_marriage_day = '';
    public $date_of_marriage_month = '';
    public $date_of_marriage_year = '';
    public $marriage_country = '';

    public function render()
    {
        return view('livewire.marriage-certificate');
    }

    public function saveStep1()
    {
        $dob_lower = 1900;
        $dob_upper = date('Y');
        $this->withValidator(function (Validator $validator) {
            $validator->after(function (Validator $validator) {
                $data = $validator->getData();
                if (!empty($data['dob_month']) && !empty($data['dob_day']) && !empty($data['dob_year'])) {
                    $month = str_pad($data['dob_month'], 2, "0",STR_PAD_LEFT);
                    $day = str_pad($data['dob_day'], 2, "0",STR_PAD_LEFT);
                    $date = "{$data['dob_year']}-{$month}-{$day}";
                    $parsed = date("Y-m-d", strtotime($date));
                    if ($date !== $parsed) {
                        $validator->errors()->add('dob_day', 'Invalid date');
                        $validator->errors()->add('dob_month', 'Invalid date');
                        $validator->errors()->add('dob_year', 'Invalid date');
                    }
                }
            });
        })->validate([
            'first_name' => 'required|max:200',
            'last_name' => 'required|max:200',
            'address' => 'required|max:200',
            'city' => 'required|max:200',
            'country' => 'required|max:200',
            'dob_day' => 'required|integer|between:1,31',
            'dob_month' => 'required|integer|between:1,12',
            'dob_year' => "required|integer|between:{$dob_lower},{$dob_upper}",
        ]);
        $this->step = 2;
    }

    public function backToStep1()
    {
        $this->step = 1;
    }

    public function saveStep2()
    {
        $dom_lower = 1900;
        $dom_upper = date('Y') + 30;
        $this->withValidator(function (Validator $validator) {
            $validator->after(function (Validator $validator) {
                $data = $validator->getData();
                if (!empty($data['date_of_marriage_month']) && !empty($data['date_of_marriage_day']) && !empty($data['date_of_marriage_year'])) {
                    $month = str_pad($data['date_of_marriage_month'], 2, "0",STR_PAD_LEFT);
                    $day = str_pad($data['date_of_marriage_day'], 2, "0",STR_PAD_LEFT);
                    $date = "{$data['date_of_marriage_year']}-{$month}-{$day}";
                    $parsed = date("Y-m-d", strtotime($date));
                    if ($date !== $parsed) {
                        $validator->errors()->add('date_of_marriage_day', 'Invalid date');
                        $validator->errors()->add('date_of_marriage_month', 'Invalid date');
                        $validator->errors()->add('date_of_marriage_year', 'Invalid date');
                    } elseif (!empty($data['dob_month']) && !empty($data['dob_day']) && !empty($data['dob_year'])) {
                        $dob_month = str_pad($data['dob_month'], 2, "0",STR_PAD_LEFT);
                        $dob_day = str_pad($data['dob_day'], 2, "0",STR_PAD_LEFT);
                        $dob_date = "{$data['dob_year']}-{$dob_month}-{$dob_day}";
                        $dob_parsed = date("Y-m-d", strtotime($dob_date));

                        $date_of_marriage_month = str_pad($data['date_of_marriage_month'], 2, "0",STR_PAD_LEFT);
                        $date_of_marriage_day = str_pad($data['date_of_marriage_day'], 2, "0",STR_PAD_LEFT);
                        $date_of_marriage_date = "{$data['date_of_marriage_year']}-{$date_of_marriage_month}-{$date_of_marriage_day}";
                        $date_of_marriage_parsed = date("Y-m-d", strtotime($date_of_marriage_date));

                        if ($dob_date === $dob_parsed && $date_of_marriage_date === $date_of_marriage_parsed) {
                            $dob = Carbon::parse($dob_date);
                            $dom = Carbon::parse($date_of_marriage_date);
                            if ($dob->diffInYears($dom) < 18) {
                                $validator->errors()->add('date_of_marriage_day', 'You are not eligible to apply because your marriage occurred before your 18th birthday.');
                                $validator->errors()->add('date_of_marriage_month', 'You are not eligible to apply because your marriage occurred before your 18th birthday.');
                                $validator->errors()->add('date_of_marriage_year', 'You are not eligible to apply because your marriage occurred before your 18th birthday.');
                            }
                        }
                    }
                }
            });
        })->validate([
            'is_married' => 'required|in:Y,N',
            'is_widowed' => 'required_if:is_married,N|in:Y,N',
            'was_married' => 'required_if:is_married,N|in:Y,N',
            'date_of_marriage_day' => 'required_if:is_married,Y|integer|between:1,31',
            'date_of_marriage_month' => 'required_if:is_married,Y|integer|between:1,12',
            'date_of_marriage_year' => "required_if:is_married,Y|integer|between:{$dom_lower},{$dom_upper}",
            'marriage_country' => 'required_if:is_married,Y|max:200',
        ]);
        $this->step = 3;
    }

    public function hasDomEntered()
    {
        return !empty($this->date_of_marriage_month) && !empty($this->date_of_marriage_day) && !empty($this->date_of_marriage_year);
    }
    public function isOfAge()
    {
        $return = false;
        if (!empty($this->dob_month) && !empty($this->dob_day) && !empty($this->dob_year)
            && !empty($this->date_of_marriage_month) && !empty($this->date_of_marriage_day) && !empty($this->date_of_marriage_year)
        ) {
            $dob_month = str_pad($this->dob_month, 2, "0",STR_PAD_LEFT);
            $dob_day = str_pad($this->dob_day, 2, "0",STR_PAD_LEFT);
            $dob_date = "{$this->dob_year}-{$dob_month}-{$dob_day}";
            $dob_parsed = date("Y-m-d", strtotime($dob_date));

            $date_of_marriage_month = str_pad($this->date_of_marriage_month, 2, "0",STR_PAD_LEFT);
            $date_of_marriage_day = str_pad($this->date_of_marriage_day, 2, "0",STR_PAD_LEFT);
            $date_of_marriage_date = "{$this->date_of_marriage_year}-{$date_of_marriage_month}-{$date_of_marriage_day}";
            $date_of_marriage_parsed = date("Y-m-d", strtotime($date_of_marriage_date));


            if ($dob_date === $dob_parsed && $date_of_marriage_date === $date_of_marriage_parsed) {
                $dob = Carbon::parse($dob_date);
                $dom = Carbon::parse($date_of_marriage_date);
                if ($dob->diffInYears($dom) >= 18) {
                    $return = true;
                }
            }
        }
        return $return;
    }
}
