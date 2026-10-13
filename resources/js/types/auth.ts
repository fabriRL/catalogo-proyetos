export type User = {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    cargo: string | null;
    roles: string[];
    [key: string]: unknown;
};

export type Auth = {
    user: User;
};
