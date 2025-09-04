import { EmptyState } from '@/components/empty-state';
import { Avatar, AvatarFallback } from '@/components/ui/avatar';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { useInitials } from '@/hooks/use-initials';
import { cn } from '@/lib/utils';
import { Button } from '@headlessui/react';
import { DropdownMenu, DropdownMenuContent, DropdownMenuItem, DropdownMenuSeparator, DropdownMenuTrigger } from '@radix-ui/react-dropdown-menu';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@radix-ui/react-select';
import {
    ColumnDef,
    ColumnFiltersState,
    flexRender,
    getCoreRowModel,
    getFilteredRowModel,
    getSortedRowModel,
    SortingState,
    useReactTable,
} from '@tanstack/react-table';
import { ChevronLeft, ChevronRight, ChevronsLeft, ChevronsRight, EllipsisVertical, Eye, Trash2 } from 'lucide-react';

import React from 'react';

interface Organization {
    id: string;
    added_by_system_admin: {
        first_name: string;
        last_name: string;
    };
    name: string;
    acronym: string;
    created_at: string;
    official_email: string;
}

interface PaginationMeta {
    current_page: number;
    from: number;
    last_page: number;
    path: string;
    per_page: number;
    to: number;
    total: number;
}

interface PaginationLinks {
    first: string;
    last: string;
    prev: string | null;
    next: string | null;
}

export default function OrganizationTable({
    organizations: data,
    paginationPayload: { meta, links },
}: {
    organizations: Organization[];
    paginationPayload: {
        meta: PaginationMeta;
        links: PaginationLinks;
    };
}) {
    const getInitials = useInitials();

    const [sorting, setSorting] = React.useState<SortingState>([]);
    const [columnFilters, setColumnFilters] = React.useState<ColumnFiltersState>([]);
    const [rowSelection, setRowSelection] = React.useState({});
    const [globalFilter, setGlobalFilter] = React.useState('');

    const columns: ColumnDef<Organization>[] = React.useMemo(() => [
        {
            accessorKey: 'name',
            header: 'Organization Name',
            cell: ({ row }) => {
                const displayName = row.original.name;
                const acronym = row.original.acronym;

                return (
                    <div className="flex items-center gap-2">
                        <span className="font-medium">{displayName}</span> - <span className="font-medium">{acronym}</span>
                    </div>
                );
            },
        },
        {
            accessorKey: 'official_email',
            header: 'Official Email',
            cell: ({ row }) => {
                const email = row.getValue('official_email') as string;
                return <div className="lowercase">{email && email.trim() !== '' ? email : 'N/A'}</div>;
            },
        },
        {
            accessorKey: 'created_at',
            header: 'Registered On',
            cell: ({ row }) => {
                const createdAt = row.original.created_at;

                return (
                    <div className="flex items-center gap-2">
                        <span className="font-medium">{createdAt}</span>
                    </div>
                );
            },
            filterFn: (row, id, value) => {
                return value.includes(row.getValue(id));
            },
        },
        {
            accessorKey: 'added_by_system_admin',
            header: 'Add By System Add',
            cell: ({ row }) => {
                const firstName = row.original.added_by_system_admin.first_name;
                const lastName = row.original.added_by_system_admin.last_name;
                const displayName = `${firstName} ${lastName}`;

                return (
                    <div className="flex items-center gap-2">
                        <Avatar className="h-7 w-7">
                            <AvatarFallback className={cn('text-xs font-semibold')}>{getInitials(firstName, lastName)}</AvatarFallback>
                        </Avatar>
                        <span className="font-medium">{displayName}</span>
                    </div>
                );
            },
        },
        {
            id: 'actions',
            enableHiding: false,
            cell: ({ row }) => {
                return (
                    <DropdownMenu>
                        <DropdownMenuTrigger>
                            <Button className="h-8 w-8 p-0">
                                <span className="sr-only">Open menu</span>
                                <EllipsisVertical className="h-4 w-4" />
                            </Button>
                        </DropdownMenuTrigger>
                        <DropdownMenuContent align="end">
                            <DropdownMenuItem onClick={() => console.log('hello' + row.id)}>
                                <Eye className="h-4 w-4" />
                                View
                            </DropdownMenuItem>
                            <DropdownMenuSeparator />
                            <DropdownMenuItem className="text-red-600 focus:bg-red-50 focus:text-red-600">
                                <Trash2 className="h-4 w-4 text-red-600" />
                                Delete
                            </DropdownMenuItem>
                        </DropdownMenuContent>
                    </DropdownMenu>
                );
            },
        },
    ]);

    const table = useReactTable({
        data,
        columns,
        onSortingChange: setSorting,
        onColumnFiltersChange: setColumnFilters,
        onRowSelectionChange: setRowSelection,
        onGlobalFilterChange: setGlobalFilter,
        getCoreRowModel: getCoreRowModel(),
        getFilteredRowModel: getFilteredRowModel(),
        getSortedRowModel: getSortedRowModel(),
        state: {
            sorting,
            columnFilters,
            columnVisibility: {
                select: true,
                id: true,
                name: true,
                added_by_system_admin: true,
                acronym: true,
                office_address: false,
                official_email: true,
                actions: false,
            },
            rowSelection,
            globalFilter,
        },
    });

    return (
        <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
            <div className="rounded-md">
                <Table>
                    <TableHeader>
                        {table.getHeaderGroups().map((headerGroup) => (
                            <TableRow key={headerGroup.id} className="hover:bg-transparent data-[state=selected]:bg-transparent">
                                {headerGroup.headers.map((header) => {
                                    return (
                                        <TableHead key={header.id}>
                                            {header.isPlaceholder ? null : flexRender(header.column.columnDef.header, header.getContext())}
                                        </TableHead>
                                    );
                                })}
                            </TableRow>
                        ))}
                    </TableHeader>
                    <TableBody>
                        {table.getRowModel().rows?.length ? (
                            table.getRowModel().rows.map((row) => (
                                <TableRow
                                    key={row.id}
                                    data-state={row.getIsSelected() && 'selected'}
                                    className="hover:bg-transparent data-[state=selected]:bg-transparent"
                                >
                                    {row.getVisibleCells().map((cell) => (
                                        <TableCell key={cell.id}>{flexRender(cell.column.columnDef.cell, cell.getContext())}</TableCell>
                                    ))}
                                </TableRow>
                            ))
                        ) : (
                            <TableRow className="hover:bg-transparent data-[state=selected]:bg-transparent">
                                <TableCell colSpan={columns.length} className="h-48">
                                    <EmptyState
                                        pageType="organizations"
                                        title="No organizations found"
                                        description="Your organizations will show up here as soon as an organization is created."
                                    />
                                </TableCell>
                            </TableRow>
                        )}
                    </TableBody>
                </Table>
            </div>

            <div className="flex items-center justify-between px-2 sticky bottom-0 border-t py-3">
                <div className="flex items-center space-x-6 lg:space-x-8">
                    <div className="flex items-center space-x-2">
                        <p className="text-sm font-medium">Rows per page</p>
                        <Select
                            value={`${meta.per_page}`}
                            onValueChange={(value) => {
                                window.location.href = `${meta.path}?page=1&per_page=${value}`;
                            }}
                        >
                            <SelectTrigger className="h-8 w-[70px]">
                                <SelectValue placeholder={meta.per_page} />
                            </SelectTrigger>
                            <SelectContent side="top">
                                {[10, 20, 50, 100].map((pageSize) => (
                                    <SelectItem key={pageSize} value={`${pageSize}`}>
                                        {pageSize}
                                    </SelectItem>
                                ))}
                            </SelectContent>
                        </Select>
                    </div>
                    <div className="flex w-[100px] items-center justify-center text-sm font-medium">
                        Page {table.getState().pagination.pageIndex + 1} of {table.getPageCount()}
                    </div>
                    <div className="flex items-center justify-between px-2">
                        <div className="flex-1 text-sm text-muted-foreground">
                            Showing {meta.from} to {meta.to} of {meta.total} results
                        </div>
                        <div className="flex items-center space-x-2">
                            <Button className="hidden h-8 w-8 p-0 lg:flex" disabled={!links.prev}>
                                <a href={links.first}>
                                    <span className="sr-only">Go to first page</span>
                                    <ChevronsLeft className="h-4 w-4" />
                                </a>
                            </Button>
                            <Button className="h-8 w-8 p-0" disabled={!links.prev}>
                                <a href={links.prev ?? '#'}>
                                    <span className="sr-only">Go to previous page</span>
                                    <ChevronLeft className="h-4 w-4" />
                                </a>
                            </Button>
                            <div className="flex w-[100px] items-center justify-center text-sm font-medium">
                                Page {meta.current_page} of {meta.last_page}
                            </div>
                            <Button className="h-8 w-8 p-0" disabled={!links.next}>
                                <a href={links.next ?? '#'}>
                                    <span className="sr-only">Go to next page</span>
                                    <ChevronRight className="h-4 w-4" />
                                </a>
                            </Button>
                            <Button className="hidden h-8 w-8 p-0 lg:flex" disabled={meta.current_page === meta.last_page}>
                                <a href={links.last}>
                                    <span className="sr-only">Go to last page</span>
                                    <ChevronsRight className="h-4 w-4" />
                                </a>
                            </Button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}
