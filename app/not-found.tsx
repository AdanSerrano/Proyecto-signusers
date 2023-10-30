import { Flex, Box, Heading, Text, Link } from '@chakra-ui/react';

export default function NotFound() {
    return (
        <Flex height="100vh" alignItems="center" justifyContent="center">
            <Box bg="gray.200" p={8} textAlign="center" borderRadius="md">
                <Heading as="h2" size="md" mb={4}>¡Oops!</Heading>
                <Text mb={4}>No se pudo encontrar el recurso solicitado.</Text>
                <Link href="/home" color="blue.500">Volver a Inicio</Link>
            </Box>
        </Flex>
    );
}