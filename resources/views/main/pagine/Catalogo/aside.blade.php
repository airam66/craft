
<div class="panel events panel-success">
   <div class="panel-heading text-center"  >
       <b>
           EVENTOS
        </b>
   </div>
   <div class="panel-body">

          <ul class="list-group filter-event">
           @foreach($events as $event)
                     
          <li class="list-group-item"  > 
          <a href="{{route('searchEvent',$event->name)}}">
             <div class="name-event" style="color: #5c1028;">{{$event->name}}</div>
          </a>
          </li>
          
          @endforeach
         </ul> 
            
 </div>
       
</div>






