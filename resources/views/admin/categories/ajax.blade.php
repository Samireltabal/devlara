@if($categories->count())
<?php 
$locale = get_locale();
  		App::setLocale($locale);
?>
                    <div class="col-lg-12">
                      
                      <table class="table table-striped table-sm table-bordered table-hover table-responsive">
                        <thead class="thead-default">
                          <tr>
                            <th>{{__("ID")}}</th>
                            <th style="width:50%;">{{__("Name")}}</th>
                            <th>{{__("Total Products")}}</th>
                          <th>{{ __("Options") }}</th>

                          </tr>
                          </thead>
                          <tbody>
                            @foreach($categories as $category)
                            <tr>
                              <th class='table-inverse'>{{$category->id}}</th>
                              <td scope="row">{{$category->cat_name}}
                              <form id="EditCat-{{$category->id}}" action='{{ route('categories.edit') }}' style='display:none;' method='post' >
                                @csrf
                                <input type="hidden" name="id" value='{{$category->id}}'>
                                    <div class="form-group">
                                      <label for="cat-{{$category->id}}">Edit</label>
                                      <input type="text" class="form-control" name="category_name" id="cat-{{$category->id}}" aria-describedby="helpId" placeholder="" value="{{ $category->cat_name }}">
                                      <small id="helpId" class="form-text text-muted">Edit Category Name</small>
                                      <input type="submit" value="Edit" class='btn btn-flat btn-sm  btn-warning pull-right' style='margin-top:5px;'>
                                    </div>
                                </form>
                            </td>
                              <td>{{ $category->total() }}</td>
                              <td><a onclick="deleteCat({{$category->id}})" class='btn btn-danger btn-flat btn-xs'> <i class="fa fa-remove" aria-hidden="true"></i> </a>
                                <a onclick="editCat({{$category->id}})" class='btn btn-warning btn-flat btn-xs'> <i class="fa fa-pencil-square" aria-hidden="true"></i> </a></td>
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                        
                    </div>
                @else
                    <h3>
                    {{__("No Categories Available")}}
                    </h3>
                @endif