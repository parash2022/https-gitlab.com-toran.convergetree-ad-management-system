<tr> 
    <td>{{$children->id}}</td>
    <td>&nbsp;&nbsp; — {{$children->title}}</td>
    <td>{{$children->status}}</td>  
    <td>
       <a href="{{route('administrator.pages.edit',[$children->id])}}">Edit</a>
        <a href="{{route('administrator.pages.delete',[$children->id])}}" class="delete-data">Delete</a>
        <form class="d-none" method="post" action="{{route('administrator.pages.delete',[$children->id])}}">
            @csrf
        </form>
    </td>
</tr>