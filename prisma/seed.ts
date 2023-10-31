import { hash } from 'bcrypt';
import prisma from './prisma';

async function main() {
  const HASH = 3;
  const user = [
    {
      email: 'adan.serrano@gmail.com',
      name: 'Adan Serrano',
      password: '123456',
    },{
      email: 'disaacmaloney@gmail.com',
      name: 'David Maloney',
      password: '123456',
    },
  ];

  for (const item of user) {

    if (item.email && item.name && item.password) {
      const existingUser = await prisma.user.findUnique({
        where: { email: item.email },
      });

      if (existingUser) {

        if (!existingUser.email || !existingUser.name || !existingUser.password) {
          await prisma.user.delete({
            where: { email: item.email },
          });
        }
      }

      await prisma.user.upsert({
        where: { email: item.email },
        update: {
          email: item.email,
          name: item.name,
          password: await hash(item.password, HASH),
        },
        create: {
          email: item.email,
          name: item.name,
          password: await hash(item.password, HASH),
        },
      });
    } else {
      console.log(`Usuario con campos vacíos: ${JSON.stringify(item)}`);
    }
  }
}

main()
  .then(async () => {
    await prisma.$disconnect();
  })
  .catch(async (e) => {
    console.error(e);
    await prisma.$disconnect();
    process.exit(1);
  });