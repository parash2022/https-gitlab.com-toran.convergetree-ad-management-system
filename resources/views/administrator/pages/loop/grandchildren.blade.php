<tr> 
    <td>{{$grandchildren->id}}</td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp; —— {{$grandchildren->title}}</td>
    <td>{{$grandchildren->status}}</td>  
    <td>
       <a href="{{route('administrator.pages.edit',[$grandchildren->id])}}">Edit</a>
        <a href="{{route('administrator.pages.delete',[$grandchildren->id])}}" class="delete-data">Delete</a>
        <form class="d-none" method="post" action="{{route('administrator.pages.delete',[$grandchildren->id])}}">
            @csrf
        </form>
    </td>
</tr>