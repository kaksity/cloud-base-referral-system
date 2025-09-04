import { SidebarInset } from '@/components/ui/sidebar';
import * as React from 'react';

interface SettingsContentProps extends React.ComponentProps<'main'> {
    variant?: 'header' | 'sidebar';
}

export function SettingsContent({ variant = 'header', children, ...props }: SettingsContentProps) {
    if (variant === 'sidebar') {
        return <SidebarInset {...props}>{children}</SidebarInset>;
    }

    return (
        <main className="mx-auto flex h-full w-full max-w-7xl flex-1 flex-col gap-4 rounded-xl" {...props}>
            {children}
        </main>
    );
}
