from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
import time
import random

driver = webdriver.Chrome()

try:
    print("Step 1: Delivery Registration")

    driver.get("http://localhost/Bakery_Hub_new/common/View/register.php")
    driver.maximize_window()
    time.sleep(2)

    email = f"delivery{random.randint(1000,9999)}@test.com"

    driver.find_element(By.ID, "name").send_keys("Delivery User")
    driver.find_element(By.ID, "phone").send_keys("01911111111")
    driver.find_element(By.ID, "email").send_keys(email)
    driver.find_element(By.ID, "password").send_keys("123456")

    Select(driver.find_element(By.ID, "role")).select_by_value("delivery")

    driver.find_element(By.XPATH, "//button[@type='submit']").click()
    time.sleep(3)

    print("Delivery Registration Done")


    print("Step 2: Delivery Login")

    driver.get("http://localhost/Bakery_Hub_new/common/View/login.php")
    time.sleep(2)

    driver.find_element(By.ID, "email").send_keys(email)
    driver.find_element(By.ID, "password").send_keys("123456")

    driver.find_element(By.XPATH, "//button[@type='submit']").click()
    time.sleep(3)

    print("Delivery Login Done")


    print("Step 3: Go to Delivery Dashboard")

    driver.get("http://localhost/Bakery_Hub_new/delivery/view/delivery_dashboard.php")
    time.sleep(3)

    print("Delivery Dashboard Opened")


    print("Step 4: Mark Order Delivered")

    driver.find_element(By.XPATH, "//a[contains(text(),'Mark Delivered')]").click()
    time.sleep(3)

    print("Order Marked as Delivered")


    print("Step 5: Logout")

    driver.find_element(By.LINK_TEXT, "Logout").click()
    time.sleep(2)

    print("Logout Done")

except Exception as e:
    print("Error:", e)

finally:
    driver.quit()