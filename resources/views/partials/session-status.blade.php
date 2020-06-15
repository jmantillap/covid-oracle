@if(session('status'))


<div class="position-relative p-3 bg-navy" >
    <div class="ribbon-wrapper ">
      <div class="ribbon bg-danger ">
        Mensaje
      </div>
    </div>
    <h4>{{session('status')}}</h4>
  </div><br>

  
    
@endif
@if(session('error'))


<div class="position-relative p-3 bg-danger" >
    <div class="ribbon-wrapper ">
      <div class="ribbon bg-danger ">
        Mensaje
      </div>
    </div>
    <h4>{{session('error')}}</h4>
  </div><br>

  
    
@endif