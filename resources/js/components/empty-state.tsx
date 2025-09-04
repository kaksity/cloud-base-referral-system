import { Button } from '@/components/ui/button';
import { FolderOpen } from 'lucide-react';
import React from 'react';
import {
    ConversationsEmptyStateIcon,
    CreditCardEmptyStateIcon,
    CustomerEmptyStateIcon,
    DefaultEmptyStateIcon,
    LeadsEmptyStateIcon,
    OrdersEmptyStateIcon,
    ProductsEmptyStateIcon,
    ReportsEmptyStateIcon,
    ServicesEmptyStateIcon,
    TicketsEmptyStateIcon,
    TransactionsEmptyStateIcon,
} from './custom-icons';

// Map page types to default icons
const pageIcons: Record<string, React.ElementType> = {
    customers: CustomerEmptyStateIcon,
    leads: LeadsEmptyStateIcon,
    products: ProductsEmptyStateIcon,
    services: ServicesEmptyStateIcon,
    conversations: ConversationsEmptyStateIcon,
    inventory: FolderOpen,
    orders: OrdersEmptyStateIcon,
    tickets: TicketsEmptyStateIcon,
    transactions: TransactionsEmptyStateIcon,
    reports: ReportsEmptyStateIcon,
    payments: CreditCardEmptyStateIcon,
    default: DefaultEmptyStateIcon,
};

interface EmptyStateProps {
    pageType?: keyof typeof pageIcons; // e.g. 'customers', 'products'
    title: string;
    description: string;
    actionLabel?: string;
    onAction?: () => void;
    icon?: React.ElementType; // Optional custom icon
}

export function EmptyState({ pageType = 'default', title, description, actionLabel, onAction, icon: CustomIcon }: EmptyStateProps) {
    const Icon = CustomIcon || pageIcons[pageType] || pageIcons.default;

    return (
        <div className="flex flex-col items-center justify-center py-12 text-center">
            <div className="mb-4 flex items-center justify-center">
                <Icon className="h-[120px] w-[120px] text-muted-foreground" />
            </div>
            <h2 className="text-lg font-semibold">{title}</h2>
            <p className="mt-1 text-sm text-muted-foreground">{description}</p>
            {actionLabel && onAction && (
                <Button onClick={onAction} className="mt-4">
                    {actionLabel}
                </Button>
            )}
        </div>
    );
}
