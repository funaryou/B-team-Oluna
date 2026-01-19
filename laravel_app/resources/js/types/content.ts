import {Tag} from "@/types/tag";

export interface Content {
    id: number
    title: string
    text: string
    likes: number
    thumbnail: string
    tags: Tag[]
}
