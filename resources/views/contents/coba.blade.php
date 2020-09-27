<table>
     <tr>
          <th>id</th>
          <th>temperature</th>
          <th>humiditry</th>
     </tr>
     @foreach($dataset as $data)
          <tr>
          <td>{{$data->entry_id}}</td>
          <td>{{$data->field1}}</td>
          <td>{{$data->field2}}</td>
          </tr>
     @endforeach
</table>