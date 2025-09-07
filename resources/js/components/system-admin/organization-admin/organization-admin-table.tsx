import ProcessDeleteWardController from '@/actions/App/Http/Controllers/Web/SystemAdmin/Settings/Ward/ProcessDeleteWardController';
import { EmptyState } from '@/components/empty-state';
import { Avatar, AvatarFallback } from '@/components/ui/avatar';
import { Button } from '@/components/ui/button';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu';
import { Select, SelectContent, SelectItem, SelectTrigger, SelectValue } from '@/components/ui/select';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { useInitials } from '@/hooks/use-initials';
import { cn } from '@/lib/utils';
import { displayOrganizationAdminView } from '@/routes/web/system-admin/organization-admin';
import { OrganizationAdmin } from '@/types/organization-admin';
import { PaginationPayload } from '@/types/pagination';
import { router, useForm } from '@inertiajs/react';
import { ColumnDef, flexRender, getCoreRowModel, getFilteredRowModel, getSortedRowModel, SortingState, useReactTable } from '@tanstack/react-table';
import { ChevronLeft, ChevronRight, ChevronsLeft, ChevronsRight, MoreHorizontal } from 'lucide-react';
import React from 'react';

export default function OrganizationAdminTable({
    organizationAdmins: data,
    paginationPayload: { meta, links },
}: {
    organizationAdmins: OrganizationAdmin[];
    paginationPayload: PaginationPayload;
}) {
    const getInitials = useInitials();
    const [sorting, setSorting] = React.useState<SortingState>([]);

    const form = useForm({});

    function deleteWard(wardId: string) {
        form.delete(ProcessDeleteWardController.url({ wardId }), {
            onSuccess: () => {},
            onError: () => {},
        });
    }

    function goToViewOrganizationAdmin(organizationAdminId: string) {
        router.visit(displayOrganizationAdminView({ organizationAdminId }));
    }

    const columns: ColumnDef<OrganizationAdmin>[] = React.useMemo(
        () => [
            {
                accessorKey: 'first_name',
                header: () => <span className="text-sm font-semibold">Admin</span>,
                cell: ({ row }) => {
                    const firstName = row.original.first_name;
                    const middleName = row.original.middle_name;
                    const lastName = row.original.last_name;
                    const displayName = `${firstName} ${middleName} ${lastName}`;

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
                accessorKey: 'mobile_number',
                header: () => <span className="text-sm font-semibold">Contact Info</span>,
                cell: ({ row }) => {
                    const mobileNumber = row.original.mobile_number;
                    const email = row.original.email;
                    return (
                        <div className="flex items-center gap-2">
                            <span className="font-medium text-gray-800">{mobileNumber}</span> -
                            <span className="font-medium text-gray-800 lowercase">{email}</span>
                        </div>
                    );
                },
            },
            {
                accessorKey: 'organization.name',
                header: 'Organization Name',
                cell: ({ row }) => {
                    const displayName = row.original.organization.name;

                    return (
                        <div className="flex items-center gap-2">
                            <span className="font-medium">{displayName}</span>
                        </div>
                    );
                },
            },

            {
                accessorKey: 'added_by_system_admin',
                header: () => <span className="text-sm font-semibold">Add By System Admin</span>,
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
                header: 'Actions',
                enableSorting: false,
                cell: ({ row }) => {
                    const organization = row.original;

                    return (
                        <DropdownMenu>
                            <DropdownMenuTrigger asChild>
                                <Button variant="ghost" className="h-8 w-8 p-0">
                                    <span className="sr-only">Open menu</span>
                                    <MoreHorizontal className="h-4 w-4" />
                                </Button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent align="end">
                                <DropdownMenuLabel>Actions</DropdownMenuLabel>
                                <DropdownMenuSeparator />
                                <DropdownMenuItem onClick={() => goToViewOrganizationAdmin(organization.id)}>View</DropdownMenuItem>
                                {/* <DropdownMenuItem className="text-red-600" onClick={() => deleteWard(state.id)}>
                                    Delete
                                </DropdownMenuItem> */}
                            </DropdownMenuContent>
                        </DropdownMenu>
                    );
                },
            },
        ],
        [],
    );

    const table = useReactTable({
        data,
        columns,
        onSortingChange: setSorting,
        getCoreRowModel: getCoreRowModel(),
        getFilteredRowModel: getFilteredRowModel(),
        getSortedRowModel: getSortedRowModel(),
        state: { sorting },
    });

    return (
        <div className="flex h-full flex-1 flex-col gap-4 rounded-xl border bg-white shadow-sm">
            <div className="overflow-hidden rounded-t-xl">
                <Table>
                    <TableHeader className="sticky top-0 z-10 bg-gray-50">
                        {table.getHeaderGroups().map((headerGroup) => (
                            <TableRow key={headerGroup.id} className="hover:bg-transparent data-[state=selected]:bg-transparent">
                                {headerGroup.headers.map((header) => (
                                    <TableHead key={header.id} className="px-4 py-3 text-left text-sm font-semibold text-gray-600">
                                        {header.isPlaceholder ? null : flexRender(header.column.columnDef.header, header.getContext())}
                                    </TableHead>
                                ))}
                            </TableRow>
                        ))}
                    </TableHeader>
                    <TableBody>
                        {table.getRowModel().rows?.length ? (
                            table.getRowModel().rows.map((row, idx) => (
                                <TableRow
                                    key={row.id}
                                    data-state={row.getIsSelected() && 'selected'}
                                    className={`${idx % 2 === 0 ? 'bg-white' : 'bg-gray-50'} transition-colors hover:bg-gray-100`}
                                >
                                    {row.getVisibleCells().map((cell) => (
                                        <TableCell key={cell.id} className="px-4 py-3">
                                            {flexRender(cell.column.columnDef.cell, cell.getContext())}
                                        </TableCell>
                                    ))}
                                </TableRow>
                            ))
                        ) : (
                            <TableRow className="hover:bg-transparent data-[state=selected]:bg-transparent">
                                <TableCell colSpan={columns.length} className="h-48">
                                    <EmptyState
                                        pageType="organization admins"
                                        title="No organization admins found"
                                        description="Your organization admins will show up here as soon as a organization admin is created."
                                    />
                                </TableCell>
                            </TableRow>
                        )}
                    </TableBody>
                </Table>
            </div>

            {/* Pagination */}
            <div className="sticky bottom-0 flex items-center justify-between rounded-b-xl border-t bg-white px-4 py-3">
                <div className="flex items-center space-x-6 lg:space-x-8">
                    {/* Rows per page */}
                    <div className="flex items-center space-x-2">
                        <p className="text-sm font-medium text-gray-600">Rows per page</p>
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

                    {/* Page info */}
                    <div className="flex w-[120px] items-center justify-center text-sm font-medium text-gray-600">
                        Page {meta.current_page} of {meta.last_page}
                    </div>

                    {/* Pagination buttons */}
                    <div className="flex items-center space-x-2">
                        <Button variant="outline" className="hidden h-8 w-8 p-0 lg:flex" disabled={!links.prev}>
                            <a href={links.first}>
                                <span className="sr-only">Go to first page</span>
                                <ChevronsLeft className="h-4 w-4" />
                            </a>
                        </Button>
                        <Button variant="outline" className="h-8 w-8 p-0" disabled={!links.prev}>
                            <a href={links.prev ?? '#'}>
                                <span className="sr-only">Go to previous page</span>
                                <ChevronLeft className="h-4 w-4" />
                            </a>
                        </Button>
                        <Button variant="outline" className="h-8 w-8 p-0" disabled={!links.next}>
                            <a href={links.next ?? '#'}>
                                <span className="sr-only">Go to next page</span>
                                <ChevronRight className="h-4 w-4" />
                            </a>
                        </Button>
                        <Button variant="outline" className="hidden h-8 w-8 p-0 lg:flex" disabled={meta.current_page === meta.last_page}>
                            <a href={links.last}>
                                <span className="sr-only">Go to last page</span>
                                <ChevronsRight className="h-4 w-4" />
                            </a>
                        </Button>
                    </div>
                </div>
            </div>
        </div>
    );
}
