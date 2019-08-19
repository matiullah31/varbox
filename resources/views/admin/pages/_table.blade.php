<div class="card">
    <table class="table card-table table-vcenter js-TreeTable">
        <tr>
            <th class="sortable" data-sort="name">
                <i class="fa fa-sort mr-2"></i>Name
            </th>
            <th class="sortable d-none d-sm-table-cell" data-sort="drafted_at">
                <i class="fa fa-sort mr-2"></i>Published
            </th>
            <th class="sortable d-none d-sm-table-cell" data-sort="deleted_at">
                <i class="fa fa-sort mr-2"></i>Trashed
            </th>
            <th class="text-right d-table-cell"></th>
        </tr>
        @forelse($items as $index => $item)
            <tr>
                <td>
                    <div>{{ $item->name ?: 'N/A' }}</div>
                    <a href="{{ $item->getUrl() }}" target="_blank">
                        {{ $item->getUri() }}
                    </a>
                </td>
                <td class="d-none d-sm-table-cell">
                    <span class="badge @if($item->isDrafted()) badge-danger @else badge-success @endif">
                        {{ $item->isDrafted() ? 'No' : 'Yes' }}
                    </span>
                </td>
                <td class="d-none d-sm-table-cell">
                    <span class="badge @if($item->trashed()) badge-danger @else badge-success @endif">
                        {{ $item->trashed() ? 'Yes' : 'No' }}
                    </span>
                </td>
                <td class="text-right d-table-cell">
                    @if($item->trashed())
                        @permission('pages-restore')
                            {!! button()->restoreRecord(route('admin.pages.restore', $item->getKey())) !!}
                        @endpermission
                        @permission('pages-delete')
                            {!! button()->deleteRecord(route('admin.pages.delete', $item->getKey())) !!}
                        @endpermission
                    @else
                        @permission('pages-edit')
                            {!! button()->editRecord(route('admin.pages.edit', $item->getKey())) !!}
                        @endpermission
                        @permission('pages-delete')
                            {!! button()->deleteRecord(route('admin.pages.destroy', $item->getKey())) !!}
                        @endpermission
                    @endif
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="10">No records found</td>
            </tr>
        @endforelse
    </table>
</div>