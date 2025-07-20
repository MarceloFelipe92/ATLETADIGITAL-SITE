/** @type {import('next').NextConfig} */
const nextConfig = {
  // Se você estava usando rewrites antes, coloque-os de volta aqui,
  // mas eles NÃO são estritamente necessários para a conexão de cadastro atual,
  // pois a API Route faz o fetch direto.
  /*
  async rewrites() {
    return [
      {
        source: "/api/backend/clientes/:path*",
        destination: "http://localhost:8080/clientes/:path*",
      },
      // ... outros rewrites
    ];
  },
  */
  images: {
    remotePatterns: [
      {
        protocol: 'http',
        hostname: 'localhost',
        port: '8081', // <--- Verifique se esta é a porta que seu Next.js está usando para servir imagens
        pathname: '/produtos/imagens/**', // ou /clientes/imagens/** se for o caso das imagens de perfil
      },
      {
        protocol: 'https',
        hostname: 'placehold.co',
        // port: '', // Não precisa de porta específica para HTTPS padrão
        // pathname: '/**', // Permite qualquer caminho em placehold.co
      },
      // Se as imagens de clientes forem servidas de http://localhost:8080/clientes/imagens/, adicione:
      {
        protocol: 'http',
        hostname: 'localhost',
        port: '8081', // Porta do seu servidor PHP
        pathname: '/clientes/imagens/**', // Caminho onde as imagens de clientes serão salvas e servidas
      },
    ],
  },
};

module.exports = nextConfig;