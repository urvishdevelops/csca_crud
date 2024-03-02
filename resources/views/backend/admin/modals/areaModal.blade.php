<div class="modal fade" id="areaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel1">Sub Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form onsubmit="return false" method="POST" id="areaForm" name="areaForm">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-sm-10">
                            <input type="hidden" id="hid" name="hid" value="">
                        </div>
                    </div>



                    <div class="row mb-2">
                        <div class="form-group">
                            <label for="status" class="col-sm-2 col-form-label ">Country<span
                                    class="text-danger">*</span></label>
                            <select id="country" name="country" class="form-control col-sm-2">
                            </select>
                        </div>
                    </div>


                    <div class="row mb-2">
                        <div class="form-group">
                            <label for="state" class="col-sm-2 col-form-label ">State<span
                                    class="text-danger">*</span></label>
                            <select id="state" name="state" class="form-control col-sm-4">
                            </select>
                        </div>
                    </div>

                    <div class="row mb-2">
                        <div class="form-group">
                            <label for="city" class="col-sm-2 col-form-label ">City<span
                                    class="text-danger">*</span></label>
                            <select id="city" name="city" class="form-control col-sm-4">
                            </select>
                        </div>
                    </div>


                    <div class="row mb-2">
                        <label class="col-sm-2 col-form-label" for="basic-default-company">Area</label>
                        <div class="col-sm-5">
                            <input type="text" name="area" id="area" class="form-control" placeholder="Area">
                        </div>
                    </div>



                    <div class="row mb-3">
                        <div class="form-group">
                            <label for="status" class="col-sm-2 col-form-label ">status type<span
                                    class="text-danger">*</span></label>
                            <select id="status" name="status" class="form-control col-sm-4">
                                <option>Select a status type</option>
                                <option value="-1">Delete</option>
                                <option value="1">Active</option>
                                <option value="2">Inactive</option>
                            </select>
                        </div>
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
