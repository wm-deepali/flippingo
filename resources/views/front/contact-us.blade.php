@extends('layouts.new-master')

@section('title')
  Flippingo-Contact Us
@endsection



@section('content')
  <!--start page wrapper -->
  <div class="page-wrapper">
    <div class="page-content">
    <!--start breadcrumb-->
    <section class="py-3 border-bottom d-none d-md-flex">
      <div class="container">
      <div class="page-breadcrumb d-flex align-items-center">
        <h3 class="breadcrumb-title pe-3">Contact Us</h3>
        <div class="ms-auto">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb mb-0 p-0">
          <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i> Home</a>
          </li>
          <li class="breadcrumb-item"><a href="javascript:;">Pages</a>
          </li>
          <li class="breadcrumb-item active" aria-current="page">Contact Us</li>
          </ol>
        </nav>
        </div>
      </div>
      </div>
    </section>
    <!--end breadcrumb-->
    <!--start page content-->
    @php
    use App\Models\ContactInfo;
    $contactFooter = ContactInfo::first();
    $address = $contactFooter->full_address ?? "";
    $mapQuery = urlencode($address);
    $mapUrl = "https://maps.google.com/maps?q={$mapQuery}&t=m&z=16&output=embed&iwloc=near";
    @endphp

    <section class="py-4">
      <div class="container">
      <h3 class="d-none">Google Map</h3>
      <div class="contact-map p-3 bg-dark-1 rounded-0 shadow-none">
        <iframe src="{{ $mapUrl }}" class="w-100" height="450" style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
      </div>
      </div>
    </section>
    <section class="py-4 ">
      <div class="container">

      <div class="row">
        <div class="col-lg-12 border">
        <div class="p-3 ">
          <div class="address mb-3">
          <p class="mb-0 text-uppercase text-white">Address</p>
          <p class="mb-0 font-12">{{ $contactFooter->full_address ?? "Unit 7 Lotherton Way Garforth Leeds LS252JY"}}
          </p>
          </div>
          <div class="phone mb-3">
          <p class="mb-0 text-uppercase text-white">Phone</p>
          <p class="mb-0 font-13">Toll Free {{ $contactFooter->contact_number ?? '01132 874724' }}</p>
          <!-- <p class="mb-0 font-13">Mobile : +91-9910XXXX</p> -->
          </div>
          <div class="email mb-3">
          <p class="mb-0 text-uppercase text-white">Email</p>
          <p class="mb-0 font-13">{{ $contactFooter->email ?? 'andy@nuvemprint.com' }}</p>
          </div>
          <div class="working-days mb-3">
          <p class="mb-0 text-uppercase text-white">WORKING DAYS</p>
          <p class="mb-0 font-13">Mon - SAT / 9:00 AM - 6:00 PM</p>
          </div>
        </div>
        </div>
        <div class="col-lg-12 border">
        <div class="p-3 ">
          <form>
          <div class="form-body">
            <h6 class="mb-0 text-uppercase">Drop us a line</h6>
            <div class="my-3 border-bottom"></div>

            <div class="row">
            <div class="mb-3 col-md-6">
              <label class="form-label">Your Name</label>
              <input type="text" class="form-control" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Your Email</label>
              <input type="email" class="form-control" />
            </div>
            </div>

            <div class="row">
            <div class="mb-3 col-md-6">
              <label class="form-label">Telephone</label>
              <input type="tel" class="form-control" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Company Name</label>
              <input type="text" class="form-control" />
            </div>
            </div>

            <div class="row">
            <div class="mb-3 col-md-6">
              <label class="form-label">Your Address</label>
              <textarea class="form-control" rows="2"></textarea>
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">How did you hear about Impress? <span
                class="text-danger">*</span></label>
              <input type="text" class="form-control" placeholder="e.g., Search engine" />
            </div>
            </div>

            <div class="row">
            <div class="mb-3 col-md-6">
              <label class="form-label">If recommended, who by?</label>
              <input type="text" class="form-control" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Job Type</label>
              <input type="text" class="form-control" />
            </div>
            </div>

            <div class="row">
            <div class="mb-3 col-md-6">
              <label class="form-label">Quantity</label>
              <input type="number" class="form-control" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Finished Size</label>
              <input type="text" class="form-control" />
            </div>
            </div>

            <div class="row">
            <div class="mb-3 col-md-6">
              <label class="form-label">No. of Pages</label>
              <input type="number" class="form-control" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">No. of Colours</label>
              <input type="text" class="form-control" />
            </div>
            </div>

            <div class="row">
            <div class="mb-3 col-md-6">
              <label class="form-label">Paper Stock</label>
              <input type="text" class="form-control" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Weight</label>
              <input type="text" class="form-control" />
            </div>
            </div>

            <div class="row">
            <div class="mb-3 col-md-6">
              <label class="form-label">Artwork Supplied</label><br />
              <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="artwork" value="Yes" />
              <label class="form-check-label">Yes</label>
              </div>
              <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="artwork" value="No" />
              <label class="form-check-label">No</label>
              </div>
            </div>

            <div class="mb-3 col-md-6">
              <label class="form-label">Quote for design</label><br />
              <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="designQuote" value="Yes" />
              <label class="form-check-label">Yes</label>
              </div>
              <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="designQuote" value="No" />
              <label class="form-check-label">No</label>
              </div>
            </div>
            </div>

            <div class="row">
            <div class="mb-3 col-md-6">
              <label class="form-label">Finishing</label>
              <input type="text" class="form-control" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Preferred Proof Type</label><br />
              <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="proofType" value="Hard Copy" />
              <label class="form-check-label">Hard Copy</label>
              </div>
              <div class="form-check form-check-inline">
              <input class="form-check-input" type="radio" name="proofType" value="PDF" />
              <label class="form-check-label">PDF</label>
              </div>
            </div>
            </div>

            <div class="row">
            <div class="mb-3 col-md-6">
              <label class="form-label">Delivery Location</label>
              <input type="text" class="form-control" />
            </div>
            <div class="mb-3 col-md-6">
              <label class="form-label">Job Required By</label>
              <input type="date" class="form-control" />
            </div>
            </div>

            <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="privacyCheck" required />
            <label class="form-check-label" for="privacyCheck">I have read and accept this privacy
              policy</label>
            </div>

            <div class="mb-3">
            <button type="submit" class="btn btn-light btn-ecomm">Send Message</button>
            </div>
          </div>
          </form>

        </div>
        </div>

      </div>
      <!--end row-->
      </div>
    </section>
    <!--end start page content-->
    </div>
  </div>
  <!--end page wrapper -->
@endsection