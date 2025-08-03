import Link from "next/link";
export default function Header() {
return(
    <>
    <div className="text-center text-2xl text-blue-600">Projet de CRUDPOST </div>
    <div> 
        <ul>
            <Link href="/connexion">Connexion</Link>
            <li>Inscription</li>
        </ul> 
    </div>
    </>
);
}