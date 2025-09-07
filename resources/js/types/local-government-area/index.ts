export interface LocalGovernmentArea {
    id: string;

    name: string;
}

export interface ExtendLocalGovernmentArea {
    id: string;

    country: {
        id: string;

        name: string;
    };

    state: {
        id: string;

        name: string;
    };
    name: string;
}
