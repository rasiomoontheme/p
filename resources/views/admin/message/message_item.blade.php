@php
  $is_admin = $item->user ? true :false
@endphp
<div class="col-sm-12 col-md-12">
  <div class="card">
    <div class="card-header @if($is_admin) bg-info @else bg-warning @endif">
      <h4>【{{ $is_admin ? $item->user->name : $item->member->name }}】 {{ $item->title }} </h4>
      <ul class="card-actions">

        @if ($is_admin)
          <li>
            <button type="button"
                    data-operate="delete"
                    data-toggle="tooltip"
                    data-original-title="@lang('res.btn.delete')"
                    data-message="@lang('res.member_message.index.title_delete')"
                    data-url="{{ route('admin.messages.destroy', ['message' => $item->id]) }}">
              <i class="mdi mdi-window-close"></i>
            </button>
          </li>
        @endif
      </ul>
    </div>
    <div class="card-body">
      <p>{{ $item->content }}</p>
      <p style="text-align:right">{{ $item->created_at }}</p>
    </div>
  </div>
</div>