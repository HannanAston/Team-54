class Math {
        public static void main(String[] args) {
        Math mathTests = new Math();

        int powResult = mathTests.power(3, 3);
        System.out.println(powResult);

        int modResult = mathTests.mod(69, 5);
        System.out.println(modResult);
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