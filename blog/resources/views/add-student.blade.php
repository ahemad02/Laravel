<div>
   <h1>Add New Student</h1>

   <form action="/add-student" method="post">

   <!-- <input type="hidden" name="_method" value="PUT"> -->


   @csrf

   <input type="text" name="name" placeholder="Enter Name">
   <br>
   <br>

   <input type="email" name="email" placeholder="Enter Email">
   <br>
   <br>

   <input type="text" name="batch" placeholder="Enter Batch">

   <br>
   <br>

   <button>Add Student</button>


   </form>
</div>
