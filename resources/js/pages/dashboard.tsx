import { Head, usePage } from '@inertiajs/react';
import { Badge } from '@/components/ui/badge';
import { dashboard } from '@/routes';

export default function Dashboard() {
    const { auth } = usePage().props;

    return (
        <>
            <Head title="Inicio" />
            <div className="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
                <div className="rounded-xl border border-sidebar-border/70 p-6 dark:border-sidebar-border">
                    <h1 className="text-xl font-semibold tracking-tight">
                        Bienvenido, {auth.user.name}
                    </h1>
                    <p className="mt-1 text-sm text-muted-foreground">
                        Sesión iniciada como {auth.user.email}
                    </p>
                    {auth.user.roles.length > 0 && (
                        <div className="mt-4 flex flex-wrap gap-2">
                            {auth.user.roles.map((rol) => (
                                <Badge key={rol} variant="secondary">
                                    {rol}
                                </Badge>
                            ))}
                        </div>
                    )}
                </div>
            </div>
        </>
    );
}

Dashboard.layout = {
    breadcrumbs: [
        {
            title: 'Inicio',
            href: dashboard(),
        },
    ],
};
