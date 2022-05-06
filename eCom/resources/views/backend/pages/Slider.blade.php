{{-- Include Master Layout --}}

@extends('Backend.layout.app')

{{-- Browser Title --}}

@section('title','Slider')


{{-- Page Title --}}

@section('page-heading')

@endsection

{{-- Main Content --}}

@section('main-content')
    <div id="mainDivSlider" class="container d-none">
        <div class="row">
            <div class="col-9">
                <h2>Slider <span class="text-black-50">0</span></h2>
            </div>

            <div class="col-3 text-end">
                <button id="addNewSliderBtnId" class="btn btn-primary mb-4" ><i class="bi bi-plus"></i> Add Slider</button>
            </div>

            <div class="col-12">
                <hr class="mt-4 mb-4">
            </div>

            <div class="col-md-12 p-5">

                <table id="SliderDataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th class="th-sm">Slider Title</th>
                        <th class="th-sm">Slider Description</th>
                        <th class="th-sm">Slider Price</th>
                        <th class="th-sm">Slider Image</th>
                        <th class="th-sm">Edit</th>
                        <th class="th-sm">Delete</th>
                    </tr>
                    </thead>
                    <tbody id="sliders_table">


                    </tbody>
                </table>

            </div>
        </div>

        {{-- <div class="mb-5"></div>--}}
    </div>

    {{--loader div--}}

    <div id="loaderDivSliders" class="container">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <img class="loading-icon " src="{{asset('assets/images/loader.svg')}}">

            </div>
        </div>
    </div>

    {{--wrong div--}}

    <div id="wrongDivSliders" class="container d-none">
        <div class="row">
            <div class="col-md-12 p-5 text-center">
                <h3>Something Went Wrong!</h3>

            </div>
        </div>
    </div>


    <!-- Add new  Modal -->
    <div class="modal fade" id="addSliderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-5">
                    <div class="form-outline mb-4">

                        <div id="brandSliderForm" class="w-100">
                            <h6 class="mb-4">Add New Slider</h6>
                            <input type="text" id="sliderNameAddId" class="form-control mb-4" placeholder="Slider Title" />
                            <input type="text" id="sliderDesAddId" class="form-control mb-4" placeholder="Slider Description"/>
                            <input type="text" id="sliderPriceAddId" class="form-control mb-4" placeholder="Slider Price"/>
                            <input type="text" id="SliderBtnTextAddId" class="form-control mb-4" placeholder="Slider Button Text"/>
                            <input type="text" id="SliderBtnLinkAddId" class="form-control mb-4" placeholder="Slider Button Link"/>
                            <input type="file" class="form-control mb-4" id="SliderImgAddId" placeholder="Slider Image"/>
                            <input type="text" class="form-control mb-4" id="SliderPriorityAddId" placeholder="Slider Priority"/>

                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <button   id="sliderAddConfirmBtn" type="button" class="btn btn-danger">Add</button>

                </div>
            </div>
        </div>
    </div>




    <!-- Edit and Update Modal -->
    <div class="modal fade" id="editSliderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title">Update Slider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body text-center p-5">
                    <div class="form-outline mb-4">

                        <h6 id="sliderEditId" class="mt-4"> </h6>

                        <div id="sliderUpdateForm" class="d-none w-100">
                            <input type="text" id="sliderNameId" class="form-control mb-4" placeholder="Slider Title" />
                            <input type="text" id="sliderDesId" class="form-control mb-4" placeholder="Slider Description"/>
                            <input type="text" id="sliderPriceId" class="form-control mb-4" placeholder="Slider Price"/>
                            <input type="text" id="SliderBtnTextId" class="form-control mb-4" placeholder="Slider Button Text"/>
                            <input type="text" id="SliderBtnLinkId" class="form-control mb-4" placeholder="Slider Button Link"/>
                            <input type="file" id="SliderImgId" class="form-control mb-4"  placeholder="Slider Image"/>
                            <input type="text" id="SliderPriorityId" class="form-control mb-4"  placeholder="Slider Priority"/>

                        </div>

                        <img id="sliderEditLoader" class="loading-icon " src="{{asset('assets/images/loader.svg')}}">
                        <h3 id="sliderEditWrong" class="d-none">Something Went Wrong!</h3>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                    <button  id="sliderUpdateConfirmBtn" type="button" class="btn btn-danger">Save</button>

                </div>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteSliderModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body text-center p-3">
                    <h5 class="mt-4">Are you sure to Delete?</h5>
                    <h6 id="SliderDeleteId" class="mt-4"> </h6>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                    <button  id="SliderDeleteConfirmBtn" type="button" class="btn btn-danger">Yes</button>

                </div>
            </div>
        </div>
    </div>


@endsection


@section('script')
    <script type="text/javascript">
        getSlidersData();





    </script>
@endsection

