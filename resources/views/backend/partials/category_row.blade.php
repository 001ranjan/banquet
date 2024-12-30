<tr>
  <td>{{ $count }}</td>
  <td>
    {{ str_repeat('— ', $level) }} {{ $category->name }}
  </td>
  <td>{!! getStatusBtn($category->status) !!}</td>
  <td>
    <a class="btn btn-sm btn-info" href="{{ route('edit-food-category', [$category->id]) }}">
      <i class="fa fa-pencil"></i>
    </a>
    <button class="btn btn-danger btn-sm delete_btn" 
            data-url="{{ route('delete-food-category', [$category->id]) }}" 
            title="{{ lang_trans('btn_delete') }}">
      <i class="fa fa-trash"></i>
    </button>
  </td>
</tr>

@php $count++; @endphp

@foreach ($category->children as $child)
  @include('backend.partials.category_row', ['category' => $child, 'count' => $count, 'level' => $level + 1])
@endforeach