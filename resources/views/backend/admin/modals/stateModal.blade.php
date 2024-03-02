<div class="modal fade" id="stateModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">State Modal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false" method="POST" id="stateForm" name="stateForm">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <input type="hidden" id="hid" name="hid" value="">
                        </div>
                    </div>

                    <div class="row mb-1">
                        <label for="status" class="col-sm-2 col-form-label ">Country<span
                                class="text-danger">*</span></label>
                        <select id="country" name="country" class="form-control">
                        </select>
                    </div>

                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="basic-default-company">State</label>
                        <div class="col-sm-5">
                            <input type="text" name="state" id="state" class="form-control"
                                placeholder="state">
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
