export interface Ward {
    id: string;

    name: string;
}

export interface ExtendWard {
    id: string;

    country: {
        id: string;

        name: string;
    };

    state: {
        id: string;

        name: string;
    };

    local_government_area: {
        id: string;

        name: string;
    };

    name: string;
}
