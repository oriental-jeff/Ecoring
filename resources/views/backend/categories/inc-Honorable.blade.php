{{-- <h5 class="text-center py-4">Application Form for Creative Artistic Work</h5> --}}
{{-- <form class="form-horizontal" method="post" id="form-validate" name="demo-form" enctype="multipart/form-data" action="{{ route('backend.application.update', ['application' => $application->id] ) }}">
    @method('PATCH') --}}
	<div class="form-row">
		<div class="form-group col-md-8">
			<div class="form-row">
				<div class="form-group col-md-4">
                    <input type="hidden" id="occupationHon" name="occupationHon" value="{{ old('occupationHon') ?? 'Honorable' }}">
					<label for="hon-inputPrefix">Title:<i>*</i></label>
					<input type="text" class="form-control" id="hon-inputPrefix" name="prefixHon" value="{{ request()->route()->getActionMethod() == 'edit' ? $application->application->prefix : old('prefixHon') }}" required>
				</div>
				<div class="form-group col-md-8">
					<label for="hon-inputName">First Name / Last Name:<i>*</i></label>
					<input type="text" class="form-control" id="hon-inputName" name="fullnameHon" value="{{ request()->route()->getActionMethod() == 'edit' ? $application->application->fullname : old('fullnameHon') }}" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label for="hon-inputInstitute">Institute / Organization:<i>*</i></label>
					<input type="text" class="form-control" id="hon-inputInstitute" name="organizationHon" value="{{ request()->route()->getActionMethod() == 'edit' ? $application->application->organization : old('organizationHon') }}" required>
				</div>
			</div>
		</div>
		<div class="form-group col-md-4">
            @if (request()->route()->getActionMethod() == 'create')
                <label for="hon-inputPicture" class="text-center d-block">Profile Picture<i>*</i></label>
                <div class="box-Profile">
                    <img id="preview_profile_pictureHon" src="{{ asset('images/img-Profile-Picture.jpg') }}" class="img-Profile-Picture">
                    <input type="file" class="form-control" id="hon-inputPicture" name="profile_pictureHon" required>
                    <label for="hon-inputPicture" class="button-Profile"><i class="fa fa-camera" style="position: relative; top: 3px;"></i></label>
                </div>
                <span class="span-head-color text-center d-block">must be smaller than 5 KB</span>
                <div class="text-danger">
                    {{ $errors->first('profile_pictureHon') }}
                </div>
            @else
                <div class="box-Profile">
                    <img src="{{ request()->route()->getActionMethod() == 'edit' ? $application->application->{"profile_picture".substr($application->application->occupation, 0, 3)} : asset('images/img-Profile-Picture.jpg') }}" class="img-Profile-Picture">
                </div>
            @endif
		</div>
	</div>

	<h5 class="font-weight-normal b-head">Mailing Address</h5>
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="hon-inputHouse">House or Building Number:<i>*</i></label>
			<input type="text" class="form-control" id="hon-inputHouse" name="buildingHon" value="{{ request()->route()->getActionMethod() == 'edit' ? $application->application->building : old('buildingHon') }}" required>
		</div>
		<div class="form-group col-md-6">
			<label for="hon-inputStreet">Street:<i>*</i></label>
			<input type="text" class="form-control" id="hon-inputStreet" name="streetHon" value="{{ request()->route()->getActionMethod() == 'edit' ? $application->application->street : old('streetHon') }}" required>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-4">
			<label for="hon-inputCity">City:<i>*</i></label>
			<input type="text" class="form-control" id="hon-inputCity" name="cityHon" value="{{ request()->route()->getActionMethod() == 'edit' ? $application->application->city : old('cityHon') }}" required>
		</div>
		<div class="form-group col-md-4">
			<label for="hon-inputCountry">Country:<i>*</i></label>
			<input type="text" class="form-control" id="hon-inputCountry" name="countryHon" value="{{ request()->route()->getActionMethod() == 'edit' ? $application->application->country : old('countryHon') }}" required>
		</div>
		<div class="form-group col-md-4">
			<label for="hon-inputCode">Zip Code:<i>*</i></label>
			<input type="text" class="form-control" id="hon-inputCode" name="zipcodeHon" value="{{ request()->route()->getActionMethod() == 'edit' ? $application->application->zipcode : old('zipcodeHon') }}" required>
		</div>
	</div>
	<div class="form-row">
		<div class="form-group col-md-6">
			<label for="hon-inputMobile">Mobile:<i>*</i></label>
			<input type="tel" class="form-control" id="hon-inputMobile" name="mobileHon" value="{{ request()->route()->getActionMethod() == 'edit' ? $application->application->mobile : old('mobileHon') }}" required>
		</div>
		<div class="form-group col-md-6">
			<label for="hon-inputStreet">E-mail Address:<i>*</i></label>
			<input type="email" class="form-control" id="hon-inputEmail" name="emailHon" value="{{ request()->route()->getActionMethod() == 'edit' ? $application->application->email : old('emailHon') }}" required>
		</div>
	</div>

	<!--//////// create a Project ////////-->
	<div class="box-create-Project" id="createProject1">
		<h5 class="b-head">Submit Project</h5>
		<div class="form-row">
			<div class="form-group col-md-12">
				<label for="hon-inputTitle">Title:<i>*</i></label>
				<input type="text" class="form-control" id="hon-inputTitle" name="titleHon1" value="{{ request()->route()->getActionMethod() == 'edit' ? $application->title : old('titleHon1') }}" required>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="hon-inputPublished">Year Published:</label>
				<input type="text" class="form-control" id="hon-inputPublished" name="year_publishedHon1" value="{{ request()->route()->getActionMethod() == 'edit' ? $application->year_published : old('year_publishedHon1') }}">
			</div>
			<div class="form-group col-md-6">
				<label for="hon-inputDimensions">Dimensions or Length (Min.):</label>
				<input type="text" class="form-control" id="hon-inputDimensions" name="dimensionsHon1" value="{{ request()->route()->getActionMethod() == 'edit' ? $application->dimensions : old('dimensionsHon1') }}">
			</div>
		</div>

		<h6 class="font-weight-normal b-head">Medium / Technique:<span class="span-head-color">(Choose from the list below)</span></h6>
		<div class="form-row">
			<div class="form-group box-check">
				<input class="form-check-input" type="radio" id="hon-gridCheck1" name="techniqueHon1" value="Painting" onclick="checkMedium(this.value,'hon-inputOther');" checked>
				<label class="form-check-label" for="hon-gridCheck1">
					Painting
				</label>
			</div>
			<div class="form-group box-check">
				<input class="form-check-input" type="radio" id="hon-gridCheck2" name="techniqueHon1" value="Printmaking" onclick="checkMedium(this.value,'hon-inputOther');">
				<label class="form-check-label" for="hon-gridCheck2">
					Printmaking
				</label>
			</div>
			<div class="form-group box-check">
				<input class="form-check-input" type="radio" id="hon-gridCheck3" name="techniqueHon1" value="Sculpture" onclick="checkMedium(this.value,'hon-inputOther');">
				<label class="form-check-label" for="hon-gridCheck3">
					Sculpture
				</label>
			</div>
			<div class="form-group box-check">
				<input class="form-check-input" type="radio" id="hon-gridCheck4" name="techniqueHon1" value="Mixed Media" onclick="checkMedium(this.value,'hon-inputOther');">
				<label class="form-check-label" for="hon-gridCheck4">
					Mixed Media
				</label>
			</div>
			<div class="form-group box-check">
				<input class="form-check-input" type="radio" id="hon-gridCheck5" name="techniqueHon1" value="Photography" onclick="checkMedium(this.value,'hon-inputOther');">
				<label class="form-check-label" for="hon-gridCheck5">
					Photography
				</label>
			</div>
			<div class="form-group box-check">
				<input class="form-check-input" type="radio" id="hon-gridCheck6" name="techniqueHon1" value="Ceramics" onclick="checkMedium(this.value,'hon-inputOther');">
				<label class="form-check-label" for="hon-gridCheck6">
					Ceramics
				</label>
			</div>
			<div class="form-group box-check">
				<input class="form-check-input" type="radio" id="hon-gridCheck7" name="techniqueHon1" value="Interior Design" onclick="checkMedium(this.value,'hon-inputOther');">
				<label class="form-check-label" for="hon-gridCheck7">
					Interior Design
				</label>
			</div>
			<div class="form-group box-check">
				<input class="form-check-input" type="radio" id="hon-gridCheck8" name="techniqueHon1" value="Product Design" onclick="checkMedium(this.value,'hon-inputOther');">
				<label class="form-check-label" for="hon-gridCheck8">
					Product Design
				</label>
			</div>
			<div class="form-group box-check">
				<input class="form-check-input" type="radio" id="hon-gridCheck9" name="techniqueHon1" value="Fashion Design" onclick="checkMedium(this.value,'hon-inputOther');">
				<label class="form-check-label" for="hon-gridCheck9">
					Fashion Design
				</label>
			</div>
			<div class="form-group box-check">
				<input class="form-check-input" type="radio" id="hon-gridCheck10" name="techniqueHon1" value="Textile Design" onclick="checkMedium(this.value,'hon-inputOther');">
				<label class="form-check-label" for="hon-gridCheck10">
					Textile Design
				</label>
			</div>
			<div class="form-group box-check">
				<input class="form-check-input" type="radio" id="hon-gridCheck11" name="techniqueHon1" value="Graphic Design" onclick="checkMedium(this.value,'hon-inputOther');">
				<label class="form-check-label" for="hon-gridCheck11">
					Graphic Design
				</label>
			</div>
			<div class="form-group box-check">
				<input class="form-check-input" type="radio" id="hon-gridCheck12" name="techniqueHon1" value="Visual Communication Design" onclick="checkMedium(this.value,'hon-inputOther');">
				<label class="form-check-label" for="hon-gridCheck12">
					Visual Communication Design
				</label>
			</div>
			<div class="form-group box-check">
				<input class="form-check-input" type="radio" id="hon-gridCheck13" name="techniqueHon1" value="Film / Video" onclick="checkMedium(this.value,'hon-inputOther');">
				<label class="form-check-label" for="hon-gridCheck13">
					Film / Video
				</label>
			</div>
			<div class="form-group box-check">
				<input class="form-check-input" type="radio" id="hon-gridCheck14" name="techniqueHon1" value="Animation" onclick="checkMedium(this.value,'hon-inputOther');">
				<label class="form-check-label" for="hon-gridCheck14">
					Animation
				</label>
			</div>
			<div class="form-group box-check">
				<input class="form-check-input" type="radio" id="hon-gridCheck15" name="techniqueHon1" value="Digital Art" onclick="checkMedium(this.value,'hon-inputOther');">
				<label class="form-check-label" for="hon-gridCheck15">
					Digital Art
				</label>
			</div>
			<div class="form-group box-check">
				<input class="form-check-input" type="radio" id="hon-gridCheck16" name="techniqueHon1" value="Multimedia" onclick="checkMedium(this.value,'hon-inputOther');">
				<label class="form-check-label" for="hon-gridCheck16">
					Multimedia
				</label>
			</div>
			<div class="form-group box-check">
				<input class="form-check-input" type="radio" id="hon-gridCheck17" name="techniqueHon1" value="Illustration" onclick="checkMedium(this.value,'hon-inputOther');">
				<label class="form-check-label" for="hon-gridCheck17">
					Illustration
				</label>
			</div>
			<div class="form-group box-check">
				<input class="form-check-input" type="radio" id="hon-gridCheck18" name="techniqueHon1" value="2-3 Dimensional Design" onclick="checkMedium(this.value,'hon-inputOther');">
				<label class="form-check-label" for="hon-gridCheck18">
					2-3 Dimensional Design
				</label>
			</div>
			<div class="form-group box-check box-check-width2">
				<input class="form-check-input" type="radio" id="hon-gridCheck19" name="techniqueHon1" value="Other" onclick="checkMedium(this.value,'hon-inputOther');">
				<label class="form-check-label" for="hon-gridCheck19">
					Other
					<input type="text" id="hon-inputOther" name="technique_otherHon1" value="{{ old('technique_otherHon1') }}" class="px-2" disabled>
				</label>
			</div>
		</div>

		{{-- <div class="form-row">
			<label class="form-check-label p-2" for="fac-textareaAbstract">
				Abstract Form for Creative Work<i>*</i> <span class="span-head-color">(450 Words Maximum)</span>
			</label>
			<div class="form-group col-md-12">
				<textarea class="form-control" id="hon-textareaAbstract" name="abstract_formHon1" value="{{ old('abstract_formHon1') }}" rows="5" required></textarea>
			</div>
		</div> --}}

		<h5 class="b-head">Upload File</h5>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="hon-inputPoster">Poster:<i class="hon-pt-rq">*</i></label>
				<div class="form-row">
					<div class="form-group">
                        @if (request()->route()->getActionMethod() == 'create')
                        <div class="form-row">
                            <div class="col-md-6 col-sm-12">
                                <button type="button" class="btn btn-Choosefile">Choose file ...</button>
                                <input type="file" class="form-control button-file image" id="hon-inputPoster" name="image_posterHon1" placeholder="Poster" required>
                                <div class="text-danger">
                                    {{ $errors->first('image_posterHon1') }}
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <img id="preview_image_posterHon1" src="{{ asset('images/img-Cover-default.jpg') }}" class="img img-preview">
                            </div>
                        </div>
                        @else
                        <div class="form-row">
                            <div class="col-12">
                                @if ($application->{"image_poster".substr($application->application->occupation, 0, 3).'1'})
                                <img src="{{ $application->{"image_poster".substr($application->application->occupation, 0, 3).'1'} }}" class="img img-Cover">
                                @elseif ($application->{"image_poster".substr($application->application->occupation, 0, 3).'2'})
                                <img src="{{ $application->{"image_poster".substr($application->application->occupation, 0, 3).'2'} }}" class="img img-Cover">
                                @elseif ($application->{"image_poster".substr($application->application->occupation, 0, 3).'3'})
                                <img src="{{ $application->{"image_poster".substr($application->application->occupation, 0, 3).'3'} }}" class="img img-Cover">
                                @endif
                            </div>
                        </div>
                        @endif
					</div>
					<div class="form-group col-xl-9 col-lg-10 col-sm-12">
						<div class="box-text-right">JPEG file of 841.89X1190.55 pixels (Size: A3) at a resolution of 150 DPI, saved in RGB color space and a file <u>must be smaller than 5 MB</u></div>
					</div>
				</div>
			</div>
			<div class="form-group col-md-6">
				<label for="hon-inputClip">Motion Clip:<i class="hon-mc-rq">*</i></label>
				<div class="form-row">
					<div class="form-group">
                        @if (request()->route()->getActionMethod() == 'create')
						<button type="button" class="btn btn-Choosefile">Choose file ...</button>
						<input type="file" class="form-control button-file image" id="hon-inputClip" name="image_motionclipHon1" placeholder="Motion Clip" required>
                        <div class="text-danger">
                            {{ $errors->first('image_motionclipHon1') }}
                        </div>
                        @else
                            @if ($application->{"image_motionclip".substr($application->application->occupation, 0, 3).'1'})
                            <video controls src="{{ $application->{"image_motionclip".substr($application->application->occupation, 0, 3).'1'} }}">
                                Your browser does not support the video tag.
                            </video>
                            @elseif ($application->{"image_motionclip".substr($application->application->occupation, 0, 3).'2'})
                            <video controls src="{{ $application->{"image_motionclip".substr($application->application->occupation, 0, 3).'2'} }}">
                                Your browser does not support the video tag.
                            </video>
                            @elseif ($application->{"image_motionclip".substr($application->application->occupation, 0, 3).'3'})
                            <video controls src="{{ $application->{"image_motionclip".substr($application->application->occupation, 0, 3).'3'} }}">
                                Your browser does not support the video tag.
                            </video>
                            @endif
                        @endif
					</div>
					<div class="form-group col-xl-9 col-lg-10 col-sm-12">
						<div class="box-text-right">MP4 format with 1 Minute maximum length (teaser/trailer cut) the file <u>must be within 100MB</u></div>
					</div>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="hon-inputAbstract">Submit Abstract Form for Creative Work:<i>*</i></label>
				<div class="form-row">
                    @if (request()->route()->getActionMethod() == 'create')
					<div class="form-group col-xl-3 col-lg-4 col-sm-12">
						<button type="button" class="btn btn-Choosefile">Choose file ...</button>
						<input type="file" class="form-control button-file image" id="hon-inputAbstract" name="image_abstractformHon1" placeholder="Abstract Form" required>
                        <div class="text-danger">
                            {{ $errors->first('image_abstractformHon1') }}
                        </div>
					</div>
                    @else
                        <div class="form-group col-xl-9 col-lg-10 col-sm-12">
                            <div class="">
                            @if ($application->{"image_abstractform".substr($application->application->occupation, 0, 3).'1'})
                            <button type="button" class="btn pdf-file" ref="{{ $application->{'image_abstractform'.substr($application->application->occupation, 0, 3).'1'} }}" onclick="openPDF(this)">Open file</button>
                            @elseif ($application->{"image_abstractform".substr($application->application->occupation, 0, 3).'2'})
                            <button type="button" class="btn pdf-file" ref="{{ $application->{'image_abstractform'.substr($application->application->occupation, 0, 3).'2'} }}" onclick="openPDF(this)">Open file</button>
                            @elseif ($application->{"image_abstractform".substr($application->application->occupation, 0, 3).'3'})
                            <button type="button" class="btn pdf-file" ref="{{ $application->{'image_abstractform'.substr($application->application->occupation, 0, 3).'3'} }}" onclick="openPDF(this)">Open file</button>
                            @endif
                            </div>
                        </div>
                    @endif
					<div class="form-group col-xl-9 col-lg-10 col-sm-12">
						<div class="box-text-right">
							1. Length: 550 Words Maximum<br>
							2. Font: Arial, Font Size: 14 points, Single Line Spacing <br>
							3. 1 inch all around for outside margin page arrangement<br>
							4. SAVE as PDF format<br>
							<br>
							Please include the following:<br>
							1. Title<br>
							2. Introduction<br>
							3. Principles / Concept<br>
							4. Process / Methodology<br>
							5. Materials and Techniques<br>
							6. Results / Conclusion<br>
							7. References<br>
						</div>
					</div>
				</div>
			</div>
			<div class="form-group col-md-6">
				<label for="hon-inputCover">Cover Picture:<i>*</i></label>
				<div class="form-row">
                    @if (request()->route()->getActionMethod() == 'create')
					<div class="form-group col-md-12">
						<img id="preview_image_coverpictureHon1" src="{{ asset('images/img-Cover-default.jpg') }}" class="img img-Cover">
					</div>
					<div class="form-group col-xl-3 col-lg-4 col-sm-12">
						<button type="button" class="btn btn-Choosefile">Choose file ...</button>
						<input type="file" class="form-control button-file image" id="hon-inputCover" name="image_coverpictureHon1" placeholder="Cover Picture" required>
                        <div class="text-danger">
                            {{ $errors->first('image_coverpictureHon1') }}
                        </div>
					</div>
                    @else
                        <div class="form-group col-md-12">
                        @if ($application->{"image_coverpicture".substr($application->application->occupation, 0, 3).'1'})
                        <img src="{{ $application->{"image_coverpicture".substr($application->application->occupation, 0, 3).'1'} }}" class="img img-Cover">
                        @elseif ($application->{"image_coverpicture".substr($application->application->occupation, 0, 3).'2'})
                        <img src="{{ $application->{"image_coverpicture".substr($application->application->occupation, 0, 3).'2'} }}" class="img img-Cover">
                        @elseif ($application->{"image_coverpicture".substr($application->application->occupation, 0, 3).'3'})
                        <img src="{{ $application->{"image_coverpicture".substr($application->application->occupation, 0, 3).'3'} }}" class="img img-Cover">
                        @endif
                        </div>
                    @endif
					<div class="form-group col-xl-9 col-lg-10 col-sm-12">
						<div class="box-text-right">JPEG file of 350X210 pixels a file <u>must be smaller than 50 KB</u></div>
                    </div>
				</div>
			</div>
		</div>
	</div>
	<!--//////// END create a Project ////////-->

	{{-- <button type="submit" class="d-none">Sign in</button>
    <button type="reset" class="d-none">reset</button>
    @csrf
</form> --}}

@push('after-scripts')
<script>
    function generateImagePreviewHon(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#preview_' + $(input).attr('name')).attr('src', e.target.result);
            }

            reader.readAsDataURL(input.files[0]); // convert to base64 string
        }
    }

    $("#hon-inputPicture, #hon-inputPoster, #hon-inputClip, #hon-inputAbstract, #hon-inputCover").change(function() {
        generateImagePreviewHon(this);
    });
    // Show / Hide *
    $("#hon-inputPoster, #hon-inputClip, #hon-inputPoster2, #hon-inputClip2, #hon-inputPoster3, #hon-inputClip3").change(function() {
        if ($(this).attr('name') == 'image_posterHon1') {
            $('.hon-pt-rq').show();
            $('.hon-mc-rq').hide();
            // set required
            $('#hon-inputPoster').prop('required', true);
            $('#hon-inputClip').prop('required', false);
        } else if ($(this).attr('name') == 'image_motionclipHon1') {
            $('.hon-pt-rq').hide();
            $('.hon-mc-rq').show();
            // set required
            $('#hon-inputPoster').prop('required', false);
            $('#hon-inputClip').prop('required', true);
        }
    });

    /** Code Script for edit mode **/

    /** Disabled All Element **/
    function openPDF(e) {
        window.open(
            $(e).attr('ref'),
            '_blank'
        );
    }
    const thisPageInclude = {!! json_encode(request()->route()->getActionMethod()) !!};
    if (thisPageInclude == 'edit') {
        $('input').prop('disabled', true);
        $('input[name="_method"]').prop('disabled', false);
        $('input[name="active"]').prop('disabled', false);
        $('input[name="_token"]').prop('disabled', false);

        /** Radio Check **/
        const technique = {!! json_encode($application->technique) !!};
        const technique_other = {!! json_encode($application->technique_other) !!};
        if (technique === 'Other') {
            $('#hon-gridCheck19').prop('checked', true);
            $('#hon-inputOther').val(technique_other);
        } else {
            const radios = document.getElementsByName('techniqueHon1');
            var ix = 0;
            Array.from(radios).find( radio => {
                if (radio.value === technique) {
                    $(radio).prop('checked', true);
                    return true;
                }
                ix++;
            });
        }
    }
</script>

@endpush
