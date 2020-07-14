<div class="col-md-4">

        <!-- Search Widget -->
        <div class="card my-4">
          <h5 class="card-header">Search</h5>
          <div class="card-body">
            <div class="input-group">
              <input type="text" class="form-control" id="search-date" placeholder="dd/mm/yyyy">
              <span class="input-group-append">
                <button class="btn btn-secondary" type="button">Go!</button>
              </span>
            </div>
          </div>
        </div>

        <!-- Addpost Widget -->
        <div class="card my-4">
          <h5 class="card-header">Add Post</h5>
          <div class="card-body">
            <div class="input-group">
              <!-- Button to Open the Modal -->
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                Open modal
                </button>
            </div>
          </div>
        </div>

      </div>


<!-- The Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
    <form action="{{ url('post') }}" method="POST">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Modal Heading</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">

            {{ csrf_field() }}
            <div class="form-group">
                <label for="category_id">Category:</label>
                <select class="form-control" multiple id="category_id" name="category_id[]" required>
                </select>
            </div>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" required name="title" placeholder="Enter title" name="title">
            </div>
            <div class="form-group">
                <label for="des">Comment:</label>
                <textarea class="form-control" rows="5" id="des" name="des" required></textarea>
            </div>

      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>
    </form>
    </div>
  </div>
</div>
