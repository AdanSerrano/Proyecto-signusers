import { Spinner } from "@chakra-ui/react";

export default function FullSpinner() {
    return (
        <section className="flex justify-center items-center bg-black h-screen">
            <Spinner speed='3s' size='lg' color="red" width={25} height={25} />
        </section>
    );
}