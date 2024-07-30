
{{-- @dd($advertisements); --}}
<table>
    <thead>
    <tr>
        
        <th>Body</th>
        <th>Car</th>
        <th>Model</th>
    </tr>
    </thead>
    <tbody>
    @foreach($advertisements as $advertisement)
        <tr>
          
            <td>{{ $advertisement->body }}</td>
            <td>{{ $advertisement->car }}</td>
            <td>{{ $advertisement->model }}</td>
        </tr>
    @endforeach
    </tbody>
</table>