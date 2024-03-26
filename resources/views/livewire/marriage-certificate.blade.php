<div class="offset-3 col-6">
    @if($step === 1)
        <div class="mb-3">
            <label
                for="first_name"
                class="form-label"
            >
                First Name:
            </label>
            <input
                type="text"
                class="form-control"
                id="first_name"
                wire:model="first_name"
            >
            @error('first_name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-3">
            <label
                for="last_name"
                class="form-label"
            >
                Last Name:
            </label>
            <input
                type="text"
                class="form-control"
                id="last_name"
                wire:model="last_name"
            >
            @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label
                for="address"
                class="form-label"
            >
                Address:
            </label>
            <input
                type="text"
                class="form-control"
                id="address"
                wire:model="address"
            >
            @error('address') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label
                for="city"
                class="form-label"
            >
                City:
            </label>
            <input
                type="text"
                class="form-control"
                id="city"
                wire:model="city"
            >
            @error('city') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label
                for="country"
                class="form-label"
            >
                Country:
            </label>
            <input
                type="text"
                class="form-control"
                id="country"
                wire:model="country"
            >
            @error('country') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label
                for="dob_month"
                class="form-label"
            >
                DOB Month:
            </label>
            <select
                class="form-control"
                id="dob_month"
                wire:model="dob_month"
            >
                <option value="" selected>--SELECT ONE--</option>
                @for($m = 1; $m <= 12; $m++)
                    <option value="{{$m}}">{{$m}}</option>
                @endfor
            </select>
            @error('dob_month') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label
                for="dob_day"
                class="form-label"
            >
                DOB Day:
            </label>
            <select
                class="form-control"
                id="dob_day"
                wire:model="dob_day"
            >
                <option value="" selected>--SELECT ONE--</option>
                @for($d = 1; $d <= 31; $d++)
                    <option value="{{$d}}">{{$d}}</option>
                @endfor
            </select>
            @error('dob_day') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="mb-3">
            <label
                for="dob_year"
                class="form-label"
            >
                DOB Year:
            </label>
            <select
                class="form-control"
                id="dob_year"
                wire:model="dob_year"
            >
                <option value="" selected>--SELECT ONE--</option>
                @for($y = date('Y'); $y >= 1900; $y--)
                    <option value="{{$y}}">{{$y}}</option>
                @endfor
            </select>
            @error('dob_year') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between">
            <button
                wire:click.prevent="saveStep1"
                class="btn btn-primary"
            >
                Next
            </button>
        </div>
    @endif
    @if($step === 2)
        <div class="mb-3">
            <label
                for="is_married"
                class="form-label"
            >
                Are you married?:
            </label>
            <select
                class="form-control"
                id="is_married"
                wire:model.live="is_married"
            >
                <option value="" selected>--SELECT ONE--</option>
                <option value="Y">Yes</option>
                <option value="N">No</option>
            </select>
            @error('is_married') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        @if($is_married === 'Y')
            <div class="mb-3">
                <label
                    for="date_of_marriage_month"
                    class="form-label"
                >
                    Marriage Date Month:
                </label>
                <select
                    class="form-control"
                    id="date_of_marriage_month"
                    wire:model.live="date_of_marriage_month"
                >
                    <option value="" selected>--SELECT ONE--</option>
                    @for($m = 1; $m <= 12; $m++)
                        <option value="{{$m}}">{{$m}}</option>
                    @endfor
                </select>
                @error('date_of_marriage_month') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label
                    for="date_of_marriage_day"
                    class="form-label"
                >
                    Marriage Date Day:
                </label>
                <select
                    class="form-control"
                    id="date_of_marriage_day"
                    wire:model.live="date_of_marriage_day"
                >
                    <option value="" selected>--SELECT ONE--</option>
                    @for($d = 1; $d <= 31; $d++)
                        <option value="{{$d}}">{{$d}}</option>
                    @endfor
                </select>
                @error('date_of_marriage_day') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label
                    for="date_of_marriage_year"
                    class="form-label"
                >
                    Marriage Date Year:
                </label>
                <select
                    class="form-control"
                    id="date_of_marriage_year"
                    wire:model.live="date_of_marriage_year"
                >
                    <option value="" selected>--SELECT ONE--</option>
                    @for($y = date('Y')+30; $y >= 1900; $y--)
                        <option value="{{$y}}">{{$y}}</option>
                    @endfor
                </select>
                @error('date_of_marriage_year') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

            <div class="mb-3">
                <label
                    for="marriage_country"
                    class="form-label"
                >
                    Country of marriage:
                </label>
                <input
                    type="text"
                    class="form-control"
                    id="marriage_country"
                    wire:model="marriage_country"
                >
                @error('marriage_country') <span class="text-danger">{{ $message }}</span> @enderror
            </div>

        @endif
        @if($is_married === 'N')
            <div class="mb-3">
                <label
                    for="is_widowed"
                    class="form-label"
                >
                    Are you widowed/widower?:
                </label>
                <select
                    class="form-control"
                    id="is_widowed"
                    wire:model="is_widowed"
                >
                    <option value="" selected>--SELECT ONE--</option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                </select>
                @error('is_widowed') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
            <div class="mb-3">
                <label
                    for="was_married"
                    class="form-label"
                >
                    Have you ever been married in the past?
                </label>
                <select
                    class="form-control"
                    id="was_married"
                    wire:model="was_married"
                >
                    <option value="" selected>--SELECT ONE--</option>
                    <option value="Y">Yes</option>
                    <option value="N">No</option>
                </select>
                @error('was_married') <span class="text-danger">{{ $message }}</span> @enderror
            </div>
        @endif
        @if($is_married === 'Y' && $this->hasDomEntered() && !$this->isOfAge())
            <div class="mb-3">
                <span class="text-danger">
                    You are not eligible to apply because your marriage occurred before your 18th birthday.
                </span>
            </div>
        @endif
        <div class="flex items-center justify-between">
            <button
                wire:click.prevent="backToStep1"
                class="btn"
            >
                Previous
            </button>
            @if($is_married === 'N' || ($is_married === 'Y' && $this->isOfAge()))
                <button
                    wire:click.prevent="saveStep2"
                    class="btn btn-primary"
                >
                    Next
                </button>
            @endif
        </div>
    @endif
    @if($step === 3)
        <div class="mb-3">
            <strong>Name: </strong> {{$first_name}} {{$last_name}}
        </div>
        <div class="mb-3">
            <strong>Address: </strong> {{$address}}, {{$city}}, {{$country}}
        </div>
        <div class="mb-3">
            <strong>Date of birth: </strong> {{$dob_month}}/{{$dob_day}}/{{$dob_year}}
        </div>
        <div class="mb-3">
            <strong>Are you married: </strong> {{$is_married}}
        </div>
        @if($is_married === 'Y')
            <div class="mb-3">
                <strong>Date of marriage: </strong> {{$date_of_marriage_month}}/{{$date_of_marriage_day}}/{{$date_of_marriage_year}}
            </div>
            <div class="mb-3">
                <strong>Country of Marriage: </strong> {{$marriage_country}}
            </div>
        @else
            <div class="mb-3">
                <strong>Are you widowed/widower? </strong> {{$is_widowed}}
            </div>
            <div class="mb-3">
                <strong>Have you ever been married? </strong> {{$was_married}}
            </div>
        @endif

    @endif
</div>
