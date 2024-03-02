<div class="modal fade" id="countryModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Country</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false" method="POST" id="countryForm" name="countryForm">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <input type="hidden" id="hid" name="hid" value="">
                        </div>
                    </div>



                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="basic-default-company">Country</label>
                        <div class="col-sm-5">
                            <input type="text" name="country" id="country" class="form-control"
                                placeholder="Country">
                        </div>
                    </div>


                    <div class="row mb-3">
                        <label for="status" class="col-sm-2 col-form-label ">status type<span
                                class="text-danger">*</span></label>
                        <div class="col-sm-5">
                            <select id="status" name="status" class="form-control col-sm-4">
                                <option>Select a status type</option>
                                <option value="-1">Delete</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
                    </div>





                    <div class="row">
                        <div class="col-sm-10">
                            <button type="button" class="btn btn-secondary" style="margin-right: 10px;"
                                data-bs-dismiss="modal">Close</button>
                            <button type="submit" id="submit" class="btn btn-primary float-right">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
