@extends('backend.master')

@section('content')

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-12">
          <!-- general form elements -->
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Create Edit</h3>
            </div>
            <!-- /.card-header -->
            <!-- form start -->
            <form action="{{url('/admin/product/update/'.$product->id)}}" method="POST" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="name">Product Name</label>
                  <input type="text" class="form-control" value="{{$product->name}}" id="name" name="name" placeholder="Enter Product Name" required>
                </div>

                <div class="form-group">
                  <label for="sku_code">SKU Code</label>
                  <input type="text" class="form-control" value="{{$product->sku_code}}" id="sku_code" name="sku_code" placeholder="Enter Product sku code" readonly>
                </div>

                <div class="form-group">
                  <label for="cat_id">Select Category</label>
                  <select name="cat_id" id="cat_id" class="form-control">
                    <option selected disabled >Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{$category->id}}" @if($product->cat_id == $category->id)
                            selected
                        @endif>{{$category->name}}</option> 
                    @endforeach
                    
                   
                  </select>
                  
                </div>

                <div class="form-group">
                  <label for="cat_id">Select SubCategory (optional)</label>
                  <select name="sub_cat_id" id="sub_cat_id" class="form-control">
                    <option selected disabled >Select SubCategory</option>
                    @foreach ($subCategories as $subcategory)
                        <option value="{{$subcategory->id}}" @if($product->sub_cat == $subcategory->id)
                           selected 
                       @endif>{{$subcategory->name}}</option> 
                    @endforeach
                    
                   
                  </select>
                  
                </div>

                <div class="form-group" id="color_fields">
                  <label for="color">Product Color (Optional)</label>
                  @foreach ($product->color as $name)
                  <input type="text" class="form-control mt-4" id="color" value="{{$name->color_name}}"  name="color[]" placeholder="Enter Product Color" > 
                  @endforeach
                 
                </div>
                <button type="button" class="btn btn-primary" id="add_color">Add More</button>

                <div class="form-group" id="size_fields">
                  <label for="size">Product Size (Optional)</label>
                  @foreach ($product->size as $size)
                  <input type="text" class="form-control mt-4 " id="size" value="{{$size->size_name}}"  name="size[]" placeholder="Enter Product Size" >
                  @endforeach
                  
                </div>
                <button type="button" class="btn btn-primary" id="add_size">Add More</button>
      
      

                <div class="form-group">
                    <label for="qty">Quantity</label>
                    <input type="number" class="form-control" value="{{$product->qty}}" id="qty" name="qty" placeholder="Enter Product qty" required>
                </div>
        

                <div class="form-group">
                    <label for="buy_price">Buy Price</label>
                    <input type="text" class="form-control" value="{{$product->buy_price}}" id="buy_price" name="buy_price" placeholder="Enter Product price" required>
                </div>

                <div class="form-group">
                    <label for="regular_price">Regular Price</label>
                    <input type="text" class="form-control" value="{{$product->regular_price}}"id="regular_price" name="regular_price" placeholder="Enter Product regular price" required>
                </div>
        
                <div class="form-group">
                    <label for="discount_price">Discount Price</label>
                    <input type="text" class="form-control" value="{{$product->discount_price}}" id="discount_price" name="discount_price" placeholder="Enter Product discount price" required>
                </div>

                <div class="form-group">
                    <label for="product_type">Product type</label>
                    <select name="product_type" id="product_type" class="form-control">
                      <option selected disabled >Select Product type</option>
                      <option value="hot" @if ($product->product_type == "hot")
                        selected
                      @endif>Hot Product</option>
                      <option value="new" @if ($product->product_type == "New Arrival")
                        selected
                      @endif>New Arrival</option>
                      <option value="regular" @if ($product->product_type == "regular")
                        selected
                      @endif>Regular Product</option>
                      <option value="discount" @if ($product->product_type == "discount")
                        selected
                      @endif>Discount Product</option>
                    
                      
                     
                    </select>
                    
                  </div>

                   
                <div class="form-group">
                    <label for="short_desc">Short Details</label>
                    <textarea id="summernote" name="short_desc">
                    {{$product->short_desc}} 
                    </textarea>
                </div>
        
                <div class="form-group">
                    <label for="long_desc">Long Details</label>
                    <textarea id="summernote2" name="long_desc">
                    {{$product->long_desc}}    
                    </textarea>
                </div>

                <div class="form-group">
                    <label for="product_policy">Product Policy</label>
                    <textarea id="summernote3" name="product_policy">
                    {{$product->product_policy}}  
                    </textarea>
                </div>
        
                <div class="form-group">
                  <label for="image">Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="image" name="image" accept="image/*" >
                      <label class="custom-file-label" for="image">Choose file</label>
                    </div>
                  </div>
                  <img src="{{asset('backend/images/product/'.$product->image)}}" alt="" height="100" width="100">
                </div>


                <div class="form-group">
                  <label for="galleryImage">Gallery Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <input type="file" class="custom-file-input" id="galleryImage" name="galleryImage[]" accept="image/*" multiple >
                      <label class="custom-file-label" for="image">Choose file</label>
                    </div>
                  </div>
                  @foreach ($product->galleryImage as $galleryImage)
                    <img src="{{asset('backend/images/galleryImage/'.$galleryImage->image)}}" class="mt-4 mr-4" alt="" height="100" width="100">
                  @endforeach
                </div>

              </div>
              <!-- /.card-body -->

              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
          </div>


          </div>
          </div>
          </div>
        </section>


@endsection

@push('script')

<script>
    $(function () {
      // Summernote
      $('#summernote').summernote()
  
      // CodeMirror
      CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
        mode: "htmlmixed",
        theme: "monokai"
      });
    })
  </script>

<script>
    $(function () {
      // Summernote
      $('#summernote2').summernote()
  
      // CodeMirror
      CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
        mode: "htmlmixed",
        theme: "monokai"
      });
    })
  </script>

<script>
    $(function () {
      // Summernote
      $('#summernote3').summernote()
  
      // CodeMirror
      CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
        mode: "htmlmixed",
        theme: "monokai"
      });
    })
  </script>
{{-- Add more Color --}}
  <script>
    $(document).ready(function(){
      $("#add_color").click(function(){
        $("#color_fields").append(' <input type="text" class="form-control mt-3" id="color" name="color[]" placeholder="Enter Product color" >')
      })
    })
  </script>

{{-- Add more Size --}}
  <script>
    $(document).ready(function(){
      $("#add_size").click(function(){
        $("#size_fields").append(' <input type="text" class="form-control mt-3" id="size" name="size[]" placeholder="Enter Product size" >')
      })
    })
  </script>
    
@endpush

