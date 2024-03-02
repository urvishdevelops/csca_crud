@extends('backend.admin.layouts.index')

@section('admin-content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4 ps-5">Country</h4>
        <div class="card p-2">
            <div class="row gy-3">
                <div>
                    <button type="button" class="btn btn-primary float-end ms-2 mb-2 me-4" id="addCountry">
                        Add Country
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table pt-2 " id="countryTable">
                        <thead class="table-light  mt-3">
                            <tr class="text-nowrap">
                                <th class="text-dark ">Id</th>
                                <th class="text-dark ">Country</th>
                                <th class="text-dark ">Status</th>
                                <th class="text-dark ">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    @include('backend.admin.modals.countryModal');
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
        integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
@endsection

@section('admin-footer')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.2/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
        integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.js"
        integrity="sha512-WHVh4oxWZQOEVkGECWGFO41WavMMW5vNCi55lyuzDBID+dHg2PIxVufsguM7nfTYN3CEeQ/6NB46FWemzpoI6Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $('#countryForm').validate({
                rules: {
                    name: "required",
                    shortContent: "required",
                    content: "required",
                },
                messages: {
                    name: 'This field is required',
                    shortContent: 'This field is required',
                    content: 'This field is required',
                },
                submitHandler: function(form) {
                    var formData = new FormData($(form)[0]);
                    $.ajax({
                        url: "{{ route('admin.country_save') }}",
                        type: 'POST',
                        data: formData,
                        processData: false,
                        contentType: false,
                        cache: false,
                        success: function(response) {
                            if (response.msg) {
                                Swal.fire({
                                    title: "Good job!",
                                    text: response.msg,
                                    icon: "success"
                                });
                            } else {
                                Swal.fire({
                                    title: "Fill the required field!",
                                    text: response.msg,
                                    icon: "error"
                                })
                            }
                            $('#countryTable').DataTable().ajax.reload();
                        }
                    });
                }
            });

        });
    </script>
@endsection
