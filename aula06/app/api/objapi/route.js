import {NextResponse} from "next/server"

export function GET(res) {

    res = [
        { nome: "Erick" },
        { nome: "Japa" },
        { nome: "Terumiti" }
    ]

    return NextResponse.json(
        {res},
        {status: 200}
    )
}