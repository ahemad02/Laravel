<div>
    <h1>Upload File</h1>

    <form action="upload" method="post" enctype="multipart/form-data">

    @csrf

    <input type="file" name="file" id="">

    <br>
    <br>

    <button>Upload</button>

    </form>
</div>
