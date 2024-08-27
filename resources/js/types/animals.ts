export interface TypeAnimal {
    images: { url: string; animal_id: number }[];
    owner_id: number;
    owner: { name: string; id: number; phone: string };
    id: number;
    name: string;
    age: number;
    type: string;
    race: string;
    price: number;
    description: string;
    status: string;
  }
