class Math {
        public static void main(String[] args) {
        Math mathTests = new Math();

        int maxResult = mathTests.max(5, 12);
        System.out.println(maxResult);

        int minResult = mathTests.min(69, 12);
        System.out.println(minResult);

        int powResult = mathTests.power(3, 3);
        System.out.println(powResult);

        int modResult = mathTests.mod(69, 5);
        System.out.println(modResult);
    }

    public int max(int a, int b){
        if(a > b){
            return a;
        }
        else if (b > a){
            return b;
        }
        else{
            return a;
        }
    }
    public int min(int a, int b){
        if(a > b){
            return b;
        }
        else if (b > a){
            return a;
        }
        else{
            return a;
        }
    }

    public int power(double base, double coefficient) {
        int result = (int) java.lang.Math.pow(base, coefficient);
        return result;
    }

    public int mod(int dividend, int divisor) {
        int result = dividend % divisor;
        return result;
    }
}
