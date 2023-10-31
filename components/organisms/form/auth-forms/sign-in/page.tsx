'use client';
import React from 'react';
import { ViewIcon, ViewOffIcon } from '@chakra-ui/icons';
import { Box, Button, FormControl, FormLabel, IconButton, Input, InputGroup, InputRightElement, Stack } from '@chakra-ui/react';
import { Formik } from 'formik';
import { useRouter } from 'next/navigation';
import { useState } from 'react';
import { TypeOf, object, string } from 'zod';
import { toFormikValidationSchema } from 'zod-formik-adapter';

type LoginFormInputs = TypeOf<typeof loginFormSchema>;


const loginFormSchema = object({
    password: string().min(6, 'Mínimo de 6 caracteres'),
    email: string().email('Por favor ingrese un correo válido'),
});

const SignInPage: React.FC = () => {
    const [error, setError] = useState<string | null>(null);
    const [isOpen, setIsOpen] = useState<boolean>(false);
    const router = useRouter();

    const handleLogin = async (values: LoginFormInputs) => {
        try {
            const response = await fetch('/api/sign-in', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(values),
            });

            const data = await response.json();

            if (response.ok) {
                router.push('/home');
            } else {
                setError(data.message);
            }
        } catch (error) {
            console.error('Error durante la autenticación:', error);
            setError('Error durante la autenticación. Por favor, inténtalo de nuevo.');
        }
    };

    return (
        <Formik<LoginFormInputs>
            initialValues={{
                email: '',
                password: '',
            }}
            onSubmit={handleLogin}
            validationSchema={toFormikValidationSchema(loginFormSchema)}
        >
            {(formik) => (
                <form onSubmit={formik.handleSubmit}>
                    <Box
                        py={{ base: '0', sm: '8' }}
                        px={{ base: '4', sm: '10' }}
                        bg={{ base: 'transparent', sm: 'bg.surface' }}
                        boxShadow={{ base: 'none', sm: 'md' }}
                        borderRadius={{ base: 'md', sm: 'xl' }}
                    >
                        <Stack spacing="5">
                            <FormControl>
                                <FormLabel htmlFor="email">Correo Electrónico</FormLabel>
                                <Input id="email" type="email" placeholder="correo@gmail.com" fontSize={16} focusBorderColor='lime' {...formik.getFieldProps('email')} />
                            </FormControl>

                            <FormControl>
                                <FormLabel htmlFor="password">Contraseña</FormLabel>
                                <InputGroup>
                                    <Input id="password" type={isOpen ? 'text' : 'password'} placeholder='contraseña' focusBorderColor='lime' fontSize={16} {...formik.getFieldProps('password')} />
                                    <InputRightElement>
                                        <IconButton
                                            variant="text"
                                            aria-label={isOpen ? 'Ocultar contraseña' : 'Mostrar contraseña'}
                                            onClick={() => setIsOpen(!isOpen)}
                                            colorScheme="black"
                                            icon={isOpen ? <ViewOffIcon /> : <ViewIcon />}
                                        />
                                    </InputRightElement>
                                </InputGroup>
                                <div className="text-red-800 text-md text-center rounded p-2">{error}</div>
                            </FormControl>
                            <Button
                                colorScheme="blue"
                                width={'100%'}
                                type="submit"
                                isLoading={formik.isSubmitting}
                                loadingText="Validando credenciales..."
                                isDisabled={formik.isSubmitting}
                            >
                                Iniciar Sesión
                            </Button>
                        </Stack>
                    </Box>
                </form>
            )}
        </Formik>
    );
};

export default SignInPage;
