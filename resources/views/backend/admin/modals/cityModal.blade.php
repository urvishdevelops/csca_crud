<div class="modal fade" id="cityModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">City</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false" method="POST" id="cityForm" name="cityForm">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <input type="hidden" id="hid" name="hid" value="">
                        </div>
                    </div>



                    <div class="row mb-2">
                        <label for="status" class="col-sm-2 col-form-label ">Country<span
                                class="text-danger">*</span></label>
                        <select id="country" name="country" class="form-control col-sm-4">
                        </select>
                    </div>


                    <div class="row mb-2">
                        <label for="state" class="col-sm-2 col-form-label ">State<span
                                class="text-danger">*</span></label>
                        <select id="state" name="state" class="form-control col-sm-4">
                        </select>
                    </div>


                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="basic-default-company">City</label>
                        <div class="col-sm-5">
                            <input type="text" name="city" id="city" class="form-control" placeholder="City">
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="status" class="col-sm-2 col-form-label ">status type<span
                                class="text-danger">*</span></label>
                        <select id="status" name="status" class="form-control col-sm-4">
                            <option>Select a status type</option>
                            <option value="-1">Delete</option>
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>





                    <div class="row justify-content-end">
                        <div class="col-sm-10 justify-content-end d-flex">
                            <button type="button" class="btn btn-secondary" style="margin-right: 10px;"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="submit" class="btn btn-primary float-right w-25">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
