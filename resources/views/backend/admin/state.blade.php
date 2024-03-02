@extends('backend.admin.layouts.index')

@section('admin-content')


    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4 ps-5">State</h4>
        <div class="card p-2">
            <div class="row gy-3">
                <div>
                    <button type="button" class="btn btn-primary float-end ms-2 mb-2 me-4" id="addState">
                        Add state
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive text-nowrap">
                    <table class="table pt-2 " id="stateTable">
                        <thead class="table-light  mt-3">
                            <tr class="text-nowrap">
                                <th class="text-dark ">Id</th>
                                <th class="text-dark ">Country</th>
                                <th class="text-dark ">City</th>
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

    @include('backend.admin.modals.stateModal');
@section('admin-footer')
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.2/dist/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.min.js"
        integrity="sha512-WHVh4oxWZQOEVkGECWGFO41WavMMW5vNCi55lyuzDBID+dHg2PIxVufsguM7nfTYN3CEeQ/6NB46FWemzpoI6Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.20.0/jquery.validate.min.js"
        integrity="sha512-WMEKGZ7L5LWgaPeJtw9MBM4i5w5OSBlSjTjCtSnvFJGSVD26gE5+Td12qN5pvWXhuWaWcVwF++F7aqu9cvqP0A=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {

            var headers = $('meta[name="csrf-token"]').attr('content');


            let list = $('#stateTable').dataTable({
                searching: true,
                paging: true,
                pageLength: 10,

                "ajax": {
                    url: "{{ route('admin.list_state_data') }}",
                    type: 'POST',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                },
                columns: [{
                        data: 'id'
                    },
                    {
                        data: 'country'
                    },
                    {
                        data: 'state'
                    },
                    {
                        data: 'status'
                    },
                    {
                        data: 'action'
                    }
                ],
            });



            $("#stateForm").submit(function() {
                var formData = new FormData($("#stateForm")[0]);
                $.ajax({
                    url: "{{ route('admin.state_save') }}",
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
                        $('#stateTable').DataTable().ajax.reload();
                    }
                });
            })



            function stateData() {
                $.ajax({
                    type: "GET",
                    url: "{{ route('admin.country_data') }}",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {

                        var countryOption = "";

                        countryOption += '<option value="" selected disabled>' +
                            "Please select role" +
                            '</option>'

                        for (let i = 0; i < response.length; i++) {
                            countryOption += '<option value="' + response[i].id + '">' +
                                response[i].country + '</option>';
                        }


                        $("#country").html(countryOption);
                    }
                })
            }






            $("#stateModal").on("hidden.bs.modal", function() {
                $("#stateForm")[0].reset();
                $("#hid").val("");
                $("#stateForm").trigger('reset');
                $("#stateForm").find('.error').removeClass('error');
            });

            $("#stateModal").on("hidden.bs.modal", function() {
                $("#stateForm").trigger('reset');
                $("#hid").val("");
                $("#stateForm").find('.error').removeClass('error');
            });

            stateData()



            $(document).on('click', '.edit', function() {
                let editId = this.getAttribute('id');

                $.ajax({
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        'editId': editId
                    },
                    url: "{{ route('admin.edit_state_data') }}",
                    success: function(data) {
                        $('#stateModal').modal('show');

                        let stateEdit = data['stateEdit'][0]

                        $('#hid').val(stateEdit.id);
                        $('#state').val(stateEdit.state);
                        $('#country').val(stateEdit.country);
                        $('#status').val(stateEdit.status);

                        $('#stateTable').DataTable().ajax.reload();


                    },
                    error: function(e) {
                        console.log("error", e);
                    }
                })
            })



            $(document).on('click', '#addState', function() {
                $('#stateModal').modal('show');
            });

            $(document).on('click', '#submit', function() {
                $('#stateModal').modal('hide');
            });




            $(document).on('click', '.delete', function() {

                var deleteId = this.getAttribute('id');

                Swal.fire({
                    title: "Are You Sure , You Want to Delete This?",
                    showDenyButton: true,
                    showCancelButton: true,
                    confirmButtonText: "Confirm",
                    denyButtonText: `Don't save`
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "post",
                            url: "{{ route('admin.delete_state_data') }}",
                            data: {
                                _token: $("[name='_token']").val(),
                                id: deleteId
                            },
                            success: function(response) {
                                Swal.fire({
                                    title: "Good job!",
                                    text: response.msg,
                                    icon: "success"
                                });
                                $('#stateTable').DataTable().ajax.reload();
                            },
                        });
                    }
                });



            });
        })
    </script>
@endsection
@endsection
