import ProcessUpdateSectorController from '@/actions/App/Http/Controllers/Web/SystemAdmin/Settings/Sector/ProcessUpdateSectorController';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Form } from '@inertiajs/react';
import { X } from 'lucide-react';

interface EditSectorModalProps {
    show: boolean;
    sector: {
        id: string;
        name: string;
    };
    onSave: () => void;
    onClose: () => void;
}

export default function EditSectorModal({ show, sector, onClose, onSave }: EditSectorModalProps) {
    if (!show) return null;

    return (
        <div className="bg-opacity-10 fixed inset-0 z-50 flex items-center justify-center" onClick={(e) => e.target === e.currentTarget && onClose()}>
            <div className="relative max-h-[90vh] w-full max-w-md overflow-y-auto rounded-xl bg-white p-6 shadow-lg dark:bg-neutral-900">
                <div className="mb-4 flex items-center justify-between">
                    <h2 className="text-lg font-semibold text-neutral-900 dark:text-neutral-100">Edit Sector</h2>
                    <button onClick={onClose}>
                        <X className="h-4 w-4 text-gray-500" />
                    </button>
                </div>

                <Form
                    {...ProcessUpdateSectorController.form({ sectorId: sector.id })}
                    className="grid grid-cols-1 gap-4 text-sm"
                    onSuccess={() => {
                        onSave();
                    }}
                >
                    {({ processing, errors }) => (
                        <>
                            <div className="flex flex-col space-y-1.5">
                                <Label htmlFor="sector.name">Sector Name</Label>
                                <Input id="name" name="name" type="text" defaultValue={sector.name} className="mt-1 block w-full" />
                                <InputError message={errors.name} className="mt-1" />
                            </div>

                            <div>
                                <Button type="submit" className="mt-2 w-full" disabled={processing}>
                                    Save Sector
                                </Button>
                            </div>
                        </>
                    )}
                </Form>
            </div>
        </div>
    );
}
